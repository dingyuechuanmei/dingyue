<?php
/**
 * 本程序由残风社区源码论坛提供
 *
 * www.92php.net
 * 
 * QQQ466421811  承接微擎模块破解、小程序前端、PHP解密
 */


global $_GPC, $_W;
load()->func('tpl');
$action = 'start';
$uid=$_COOKIE["uid"];
$storeid=$_COOKIE["storeid"];
$cur_store = $this->getStoreById($storeid);
$GLOBALS['frames'] = $this->getNaveMenu($storeid, $action,$uid);



$pageindex = max(1, intval($_GPC['page']));
$pagesize=10;
$type=isset($_GPC['type'])?$_GPC['type']:'all';

$where=" where a.uniacid=:uniacid and a.type=2 and a.store_id={$storeid}";
$data[':uniacid']=$_W['uniacid'];
if($_GPC['time']){
    $start=strtotime($_GPC['time']['start']);
    $end=strtotime($_GPC['time']['end']);
    $where.=" and UNIX_TIMESTAMP(a.time) >={$start} and UNIX_TIMESTAMP(a.time)<={$end}";
}
if(!empty($_GPC['keywords'])){
    $where.=" and (a.order_num LIKE  concat('%', :name,'%') || d.name LIKE  concat('%', :name,'%'))";
    $data[':name']=$_GPC['keywords'];   
}
if(!$_GPC['time'] and !$_GPC['keywords']){
$type2=isset($_GPC['type2'])?$_GPC['type2']:'today';
}
if($type=='wait'){
    $where.=" and a.dn_state=1";
}
if($type=='complete'){
    $where.=" and a.dn_state=2";
}
if($type=='close'){
    $where.=" and a.dn_state=3";
}
 if($type2=='today'){
  $time=date("Y-m-d",time());
  $where.="  and a.time LIKE '%{$time}%' ";
}
if($type2=='yesterday'){
  $time=date("Y-m-d",strtotime("-1 day"));
 $where.="  and a.time LIKE '%{$time}%' ";
}
if($type2=='week'){
$time=strtotime(date("Y-m-d",strtotime("-7 day")));

  $where.=" and UNIX_TIMESTAMP(a.time) >".$time;
}
if($type2=='month'){
  $time=date("Y-m");
  $where.="  and a.time LIKE '%{$time}%' ";
}

$sql="SELECT a.*,d.name,b.name as table_name,b.status as t_status,c.name as tablename,d.name,e.dn_poundage as md_poundage,e.poundage FROM ".tablename('cjdc_order'). " a"  . " left join " . tablename("cjdc_table") . " b on a.table_id=b.id  left join " . tablename("cjdc_table_type") ." c on b.type_id=c.id left join " . tablename("cjdc_store") ." d on a.store_id=d.id left join " . tablename("cjdc_storetype") ." e on d.md_type=e.id left join " . tablename("cjdc_storeset") ." f on a.store_id=f.store_id ".$where." ORDER BY a.time DESC";
$total=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('cjdc_order'). " a"  . " left join " . tablename("cjdc_table") . " b on a.table_id=b.id left join " . tablename("cjdc_table_type") ." c on b.type_id=c.id left join " . tablename("cjdc_store") ." d on a.store_id=d.id  left join " . tablename("cjdc_storetype") ." e on d.md_type=e.id left join " . tablename("cjdc_storeset") ." f on a.store_id=f.store_id ".$where." ORDER BY a.time DESC",$data);
$select_sql =$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
$list=pdo_fetchall($select_sql,$data);
$res2=pdo_getall('cjdc_order_goods');
  $data3=array();
  for($i=0;$i<count($list);$i++){
    $data4=array();
    for($k=0;$k<count($res2);$k++){
      if($list[$i]['id']==$res2[$k]['order_id']){
        $data4[]=array(
          'name'=>$res2[$k]['name'],
          'num'=>$res2[$k]['number'],
          'img'=>$res2[$k]['img'],
          'money'=>$res2[$k]['money'],
          'dishes_id'=>$res2[$k]['dishes_id']
          );
      }
    }
    $data3[]=array(
      'order'=> $list[$i],
      'goods'=>$data4
      );
  }
//var_dump($data3);die;
$pager = pagination($total, $pageindex, $pagesize);


//打印
if($_GPC['op']=='dy'){
  $result=$this->qtPrint($_GPC['order_id']);
  //$result=$this->hcPrint($_GPC['order_id']);
  message('打印成功！', $this->createWebUrl2('dldnorder'), 'success');
}





        if($_GPC['op']=='receivables'){
            $id=$_GPC['id'];
            $data2['dn_state']=2;
            $result = pdo_update('cjdc_order',$data2, array('id'=>$id));
            if($result){
                message('确认成功',$this->createWebUrl2('dlindnorder',array()),'success');
            }else{
                message('确认失败','','error');
            }
        }elseif($_GPC['op']=='close'){
            $id=$_GPC['id'];
            $table_id=$_GPC['table_id'];
            $data2['dn_state']=3;
            $result = pdo_update('cjdc_order',$data2, array('id'=>$id));
            pdo_update('cjdc_table',array('status'=>0), array('id'=>$table_id));
            if($result){
                message('关闭成功',$this->createWebUrl2('dlindnorder',array()),'success');
            }else{
                message('关闭失败','','error');
            }

        }elseif($_GPC['op']=='open'){
            $table_id=$_GPC['id'];
            $data2['status']=0;
            $result = pdo_update('cjdc_table',$data2, array('id'=>$table_id));
            if($result){
                message('重新开台成功',$this->createWebUrl2('dlindnorder',array()),'success');
            }else{
                message('重新开台失败','','error');
            }
        }
        if($_GPC['op']=='delete'){
    $res=pdo_delete('cjdc_order',array('id'=>$_GPC['id']));
    if($res){
         message('删除成功！', $this->createWebUrl2('dlindnorder'), 'success');
        }else{
              message('删除失败！','','error');
        }
}
include $this->template('web/dlindnorder');