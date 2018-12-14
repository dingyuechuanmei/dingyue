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
$GLOBALS['frames'] = $this->getMainMenu($storeid,$action);
$pageindex = max(1, intval($_GPC['page']));
$pagesize=10;
$type=isset($_GPC['type'])?$_GPC['type']:'all';
$where=" where a.uniacid=:uniacid and a.type=2";
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
// $time=date("Y-m-d");
// $time2=date("Y-m-d",strtotime("-1 day"));
// $time="'%$time%'";
// $time2="'%$time2%'";



// $wx = "select sum(money) as total from " . tablename("cjdc_order")." WHERE time LIKE ".$time."  and dn_state=2 and is_yue=2 and type=2 and pay_time !=''";
// $wx = pdo_fetch($wx);//今天的微信店内销售额
// $yue = "select sum(money) as total from " . tablename("cjdc_order")." WHERE time LIKE ".$time."  and dn_state=2 and is_yue=1 and type=2 and pay_time !=''";
// $yue = pdo_fetch($yue);//今天的余额店内销售额
// $jf = "select sum(money) as total from " . tablename("cjdc_order")." WHERE time LIKE ".$time."  and dn_state=2 and is_yue=3 and type=2 and pay_time !=''";
// $jf = pdo_fetch($jf);//今天的积分店内销售额

// $ztwx = "select sum(money) as total from " . tablename("cjdc_order")." WHERE time LIKE ".$time2."  and dn_state=2 and is_yue=2 and type=2 and pay_time !=''";
// $ztwx = pdo_fetch($ztwx);//昨天的微信店内销售额
// $ztyue = "select sum(money) as total from " . tablename("cjdc_order")." WHERE time LIKE ".$time2."  and dn_state=2 and is_yue=1 and type=2 and pay_time !=''";
// $ztyue = pdo_fetch($ztyue);//昨天的余额店内销售额
// $ztjf = "select sum(money) as total from " . tablename("cjdc_order")." WHERE time LIKE ".$time2."  and dn_state=2 and is_yue=3 and type=2 and pay_time !=''";
// $ztjf = pdo_fetch($ztjf);//昨天的积分店内销售额






// $dn2 = "select * from " . tablename("cjdc_order")." WHERE time LIKE ".$time."   and type=2 and dn_state=2 and uniacid=".$_W['uniacid'];
// $dn2 = count(pdo_fetchall($dn2));//今天店内订单量
// $wxdn2 = "select * from " . tablename("cjdc_order")." WHERE time LIKE ".$time."   and type=2 and dn_state=2 and is_yue=2 and uniacid=".$_W['uniacid'];
// $wxdn2 = count(pdo_fetchall($wxdn2));//今天店内微信订单量
// $yuedn2 = "select * from " . tablename("cjdc_order")." WHERE time LIKE ".$time."   and type=2 and dn_state=2 and is_yue=1 and uniacid=".$_W['uniacid'];
// $yuedn2 = count(pdo_fetchall($yuedn2));//今天店内余额订单量
// $jfdn2 = "select * from " . tablename("cjdc_order")." WHERE time LIKE ".$time."   and type=2 and dn_state=2 and is_yue=3 and uniacid=".$_W['uniacid'];
// $jfdn2 = count(pdo_fetchall($jfdn2));//今天店内积分订单量




// $ztdn2 = "select * from " . tablename("cjdc_order")." WHERE time LIKE ".$time2."   and type=2 and dn_state=2 and uniacid=".$_W['uniacid'];
// $ztdn2 = count(pdo_fetchall($ztdn2));//昨天店内订单量
// $ztwxdn2 = "select * from " . tablename("cjdc_order")." WHERE time LIKE ".$time2."   and type=2 and dn_state=2 and is_yue=2 and uniacid=".$_W['uniacid'];
// $ztwxdn2 = count(pdo_fetchall($ztwxdn2));//昨天店内微信订单量
// $ztyuedn2 = "select * from " . tablename("cjdc_order")." WHERE time LIKE ".$time2."   and type=2 and dn_state=2 and is_yue=1 and uniacid=".$_W['uniacid'];
// $ztyuedn2 = count(pdo_fetchall($ztyuedn2));//昨天店内余额订单量
// $ztjfdn2 = "select * from " . tablename("cjdc_order")." WHERE time LIKE ".$time2."   and type=2 and dn_state=2 and is_yue=3 and uniacid=".$_W['uniacid'];
// $ztjfdn2 = count(pdo_fetchall($ztjfdn2));//昨天店内积分订单量

//打印
if($_GPC['op']=='dy'){
  $result=$this->qtPrint($_GPC['order_id']);
  //$result=$this->hcPrint($_GPC['order_id']);
  message('打印成功！', $this->createWebUrl('dnorder'), 'success');
}

if($_GPC['op']=='sc'){
  $result = pdo_delete('cjdc_order',array('dn_state'=>3));
    if($result){
        message('删除成功',$this->createWebUrl('dnorder',array()),'success');
    }else{
        message('删除失败','','error');

    }
}


if($_GPC['op']=='receivables'){
    $id=$_GPC['id'];
    $result = pdo_update('cjdc_order',array('dn_state'=>2,'pay_time'=>date("Y-m-d H:i:s")), array('id'=>$id));
    if($result){
        message('确认成功',$this->createWebUrl('dnorder',array()),'success');
    }else{
        message('确认失败','','error');

    }
}elseif($_GPC['op']=='close'){
    $id=$_GPC['id'];
    $table_id=$_GPC['table_id'];
    // $data2['dn_state']=3;
    $result = pdo_update('cjdc_order',array('dn_state'=>3), array('id'=>$id));
    pdo_update('cjdc_table',array('status'=>0), array('id'=>$table_id));
    if($result){
        message('关闭成功',$this->createWebUrl('dnorder',array()),'success');
    }else{
        message('关闭失败','','error');

    }
}elseif($_GPC['op']=='open'){
    $table_id=$_GPC['id'];
    $data2['status']=0;
    $result = pdo_update('cjdc_table',$data2, array('id'=>$table_id));
    if($result){
        message('重新开台成功',$this->createWebUrl('dnorder',array()),'success');
    }else{
        message('重新开台失败','','error');
    }
}

if($_GPC['op']=='delete'){
    $res=pdo_delete('cjdc_order',array('id'=>$_GPC['id']));
 if($res){
 message('删除成功！', $this->createWebUrl('dnorder'), 'success');
}else{
      message('删除失败！','','error');
}
}

// if(checksubmit('export_submit', true)) {
//     $time=date("Y-m-d");
//     $time="'%$time%'";
//         $count = pdo_fetchcolumn("SELECT COUNT(*) FROM". tablename("cjdc_order")." WHERE time LIKE ".$time."and type=2");
//         $pagesize = ceil($count/5000);
//         //array_unshift( $names,  '活动名称'); 
//         $header = array(
//             'item'=>'序号',
//             'md_name' => '门店名称',
//            'order_num' => '订单号', 
//            // 'name' => '联系人', 
//            // 'tel' => '联系电话',
//            // 'address' => '联系地址',
//            'time' => '下单时间',
//            'money' => '金额',
//            'table_name' => '桌号',
//            // 'state' => '外卖状态',
//          'dn_state' => '店内状态',
//            'goods' => '商品'

//         );

//         $keys = array_keys($header);
//         $html = "\xEF\xBB\xBF";
//         foreach ($header as $li) {
//             $html .= $li . "\t ,";
//         }
//         $html .= "\n";
//         for ($j = 1; $j <= $pagesize; $j++) {
//             $sql = "select a.*,b.md_name,c.name as table_name from " . tablename("cjdc_order")."  a"  . " left join " . tablename("cjdc_store")." b on a.store_id=b.id " . " left join " . tablename("cjdc_table") . " c on c.id=a.table_id  WHERE a.time LIKE ".$time." and a.type=2  limit " . ($j - 1) * 5000 . ",5000 ";
//             $list = pdo_fetchall($sql);
   
            

//         }
//             if (!empty($list)) {
//                 $size = ceil(count($list) / 500);
//                 for ($i = 0; $i < $size; $i++) {
//                     $buffer = array_slice($list, $i * 500, 500);
//                     $user = array();
//                     foreach ($buffer as $k =>$row) {
//                         $row['item']= $k+1;
//                         // if($row['state']==0){
//                         //     $row['state']='无状态';
//                         // }elseif($row['state']==1){
//                         //     $row['state']='待付款';
//                         // }elseif($row['state']==2){
//                         //     $row['state']='等待接单';
//                         // }elseif($row['state']==3){
//                         //     $row['state']='等待送达';
//                         // }elseif($row['state']==4){
//                         //     $row['state']='完成';
//                         // }elseif($row['state']==5){
//                         //     $row['state']='取消订单';
//                         // }elseif($row['state']==6){
//                         //     $row['state']='评论完成';
//                         // }
//                         if($row['dn_state']==0){
//                             $row['dn_state']='无状态';
//                         }elseif($row['dn_state']==1){
//                             $row['dn_state']='待付款';
//                         }elseif($row['dn_state']==2){
//                             $row['dn_state']='已完成';
//                         }elseif($row['dn_state']==3){
//                             $row['dn_state']='关闭订单';
//                         }elseif($row['dn_state']==4){
//                             $row['dn_state']='已评论';
//                         }
//                         $good=pdo_getall('cjdc_order_goods',array('order_id'=>$row['id']));
//                         $date6='';
//                         for($i=0;$i<count($good);$i++){
//                             $date6 .=$good[$i]['name'].'*'.$good[$i]['number']."  ";
//                         }
//                         $row['goods']=$date6;
//                         foreach ($keys as $key) {
//                             $data5[] = $row[$key];
//                         }
//                         $user[] = implode("\t ,", $data5) . "\t ,";
//                         unset($data5);
//                     }
//                     $html .= implode("\n", $user) . "\n";
//                 }
//             }
        
//         header("Content-type:text/csv");
//         header("Content-Disposition:attachment; filename=今日店内订单数据.csv");
//         echo $html;
//         exit();
//     }
include $this->template('web/dnorder');