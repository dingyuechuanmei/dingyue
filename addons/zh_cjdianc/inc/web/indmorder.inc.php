<?php
/**
 * 本程序由残风社区源码论坛提供
 *
 * www.92php.net
 * 
 * QQQ466421811  承接微擎模块破解、小程序前端、PHP解密
 */


global $_GPC, $_W;
$storeid=$_COOKIE["storeid"];
pdo_update('wpdc_dmorder',array('state'=>2),array('state'=>0));
$system=pdo_get('wpdc_system',array('uniacid'=>$_W['uniacid']));
$cur_store = $this->getStoreById($storeid);
$GLOBALS['frames'] = $this->getMainMenu2();

$where=" where a.uniacid=:uniacid and a.type=4 and a.dm_state=2 and a.store_id={$storeid}";
$data[':uniacid']=$_W['uniacid'];
$type2=isset($_GPC['type2'])?$_GPC['type2']:'today';
if($_GPC['time']){
  $start=$_GPC['time']['start'];
  $end=$_GPC['time']['end'];
  $where.=" and a.time >='{$start}' and a.time<='{$end}'";
}

if(!empty($_GPC['keywords'])){
    $where.=" and a.order_num LIKE  concat('%', :name,'%') ";
    $data[':name']=$_GPC['keywords'];   
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
$sql="SELECT a.*,d.name,b.name as table_name,b.status as t_status,c.name as tablename,d.name,e.dm_poundage as md_poundage,e.poundage FROM ".tablename('cjdc_order'). " a"  . " left join " . tablename("cjdc_table") . " b on a.table_id=b.id  left join " . tablename("cjdc_table_type") ." c on b.type_id=c.id left join " . tablename("cjdc_store") ." d on a.store_id=d.id left join " . tablename("cjdc_storetype") ." e on d.md_type=e.id left join " . tablename("cjdc_storeset") ." f on a.store_id=f.store_id ".$where." ORDER BY a.time DESC";
$total=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('cjdc_order'). " a"  . " left join " . tablename("cjdc_table") . " b on a.table_id=b.id left join " . tablename("cjdc_table_type") ." c on b.type_id=c.id left join " . tablename("cjdc_store") ." d on a.store_id=d.id  left join " . tablename("cjdc_storetype") ." e on d.md_type=e.id left join " . tablename("cjdc_storeset") ." f on a.store_id=f.store_id ".$where." ORDER BY a.time DESC",$data);
$pageindex = max(1, intval($_GPC['page']));
$pagesize=10;
$select_sql =$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
$list=pdo_fetchall($select_sql,$data);
$pager = pagination($total, $pageindex, $pagesize);


if($_GPC['op']=='dy'){
  $result=$this->qtPrint($_GPC['order_id']);
  message('打印成功！', $this->createWebUrl('dmorder'), 'success');
}


include $this->template('web/indmorder');