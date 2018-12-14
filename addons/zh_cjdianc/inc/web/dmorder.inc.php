<?php
/**
 * 本程序由残风社区源码论坛提供
 *
 * www.92php.net
 * 
 * QQQ466421811  承接微擎模块破解、小程序前端、PHP解密
 */


global $_GPC, $_W;
$system=pdo_get('wpdc_system',array('uniacid'=>$_W['uniacid']));
pdo_update('wpdc_dmorder',array('state'=>2),array('state'=>0));
$GLOBALS['frames'] = $this->getMainMenu();
$where=" where a.uniacid=:uniacid and a.type=4 and a.dm_state=2";
$data[':uniacid']=$_W['uniacid'];
$type2=isset($_GPC['type2'])?$_GPC['type2']:'today';
if($_GPC['time']){
  $start=$_GPC['time']['start'];
  $end=$_GPC['time']['end'];
  $where.=" and a.time >='{$start}' and a.time<='{$end}'";
}

if(!empty($_GPC['keywords'])){
    $where.=" and (d.name LIKE  concat('%', :name,'%') or a.order_num LIKE  concat('%', :name,'%'))";
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
// $time=date("Y-m-d");
// $time2=date("Y-m-d",strtotime("-1 day"));
// $time="'%$time%'";
// $time2="'%$time2%'";


// $wx = "select sum(money) as total from " . tablename("wpdc_dmorder")." WHERE time LIKE ".$time."  and state=2 and is_yue=2";
// $wx = pdo_fetch($wx);//今天的微信外卖销售额
// $yue = "select sum(money) as total from " . tablename("wpdc_dmorder")." WHERE time LIKE ".$time."  and state=2 and is_yue=1";
// $yue = pdo_fetch($yue);//今天的余额外卖销售额
// $jf = "select sum(money) as total from " . tablename("wpdc_dmorder")." WHERE time LIKE ".$time."  and state=2 and is_yue=3";
// $jf = pdo_fetch($jf);//今天的积分外卖销售额

// $ztwx = "select sum(money) as total from " . tablename("wpdc_dmorder")." WHERE time LIKE ".$time2."  and state=2 and is_yue=2";
// $ztwx = pdo_fetch($ztwx);//昨天的微信外卖销售额
// $ztyue = "select sum(money) as total from " . tablename("wpdc_dmorder")." WHERE time LIKE ".$time2."  and state=2 and is_yue=1";
// $ztyue = pdo_fetch($ztyue);//昨天的余额外卖销售额
// $ztjf = "select sum(money) as total from " . tablename("wpdc_dmorder")." WHERE time LIKE ".$time2."  and state=2 and is_yue=3";
// $ztjf = pdo_fetch($ztjf);//昨天的积分外卖销售额






// $dm2 = "select * from " . tablename("wpdc_dmorder")." WHERE time LIKE ".$time." and state=2 and uniacid=".$_W['uniacid'];
// $dm2 = count(pdo_fetchall($dm2));//今天外卖订单量
// $wxdm2 = "select * from " . tablename("wpdc_dmorder")." WHERE time LIKE ".$time." and state=2 and is_yue=2 and uniacid=".$_W['uniacid'];
// $wxdm2 = count(pdo_fetchall($wxdm2));//今天外卖微信订单量
// $yuedm2 = "select * from " . tablename("wpdc_dmorder")." WHERE time LIKE ".$time." and state=2 and is_yue=1 and uniacid=".$_W['uniacid'];
// $yuedm2 = count(pdo_fetchall($yuedm2));//今天外卖余额订单量
// $jfdm2 = "select * from " . tablename("wpdc_dmorder")." WHERE time LIKE ".$time." and state=2 and is_yue=3 and uniacid=".$_W['uniacid'];
// $jfdm2 = count(pdo_fetchall($jfdm2));//今天外卖积分订单量




// $ztdm2 = "select * from " . tablename("wpdc_dmorder")." WHERE time LIKE ".$time2." and state=2 and uniacid=".$_W['uniacid'];
// $ztdm2 = count(pdo_fetchall($ztdm2));//昨天外卖订单量
// $ztwxdm2 = "select * from " . tablename("wpdc_dmorder")." WHERE time LIKE ".$time2." and state=2 and is_yue=2 and uniacid=".$_W['uniacid'];
// $ztwxdm2 = count(pdo_fetchall($ztwxdm2));//昨天外卖微信订单量
// $ztyuedm2 = "select * from " . tablename("wpdc_dmorder")." WHERE time LIKE ".$time2." and state=2 and is_yue=1 and uniacid=".$_W['uniacid'];
// $ztyuedm2 = count(pdo_fetchall($ztyuedm2));//昨天外卖余额订单量
// $ztjfdm2 = "select * from " . tablename("wpdc_dmorder")." WHERE time LIKE ".$time2." and state=2 and is_yue=3 and uniacid=".$_W['uniacid'];
// $ztjfdm2 = count(pdo_fetchall($ztjfdm2));//昨天外卖积分订单量




// $dm="select sum(money) as total from " . tablename("wpdc_dmorder")." WHERE time LIKE ".$time."  and state=2  and uniacid=".$_W['uniacid'];
// $dm = pdo_fetch($dm);//今天的店内销售额
// $ztdm="select sum(money) as total from " . tablename("wpdc_dmorder")." WHERE time LIKE ".$time2."  and state=2  and uniacid=".$_W['uniacid'];
// $ztdm = pdo_fetch($ztdm);//昨天的店内销售额



// $dm2 = "select * from " . tablename("wpdc_dmorder")." WHERE time LIKE ".$time."  and state=2  and uniacid=".$_W['uniacid'];
// $dm2 = count(pdo_fetchall($dm2));

// $ztdm2 = "select * from " . tablename("wpdc_dmorder")." WHERE time LIKE ".$time2."   and state=2  and uniacid=".$_W['uniacid'];
// $ztdm2 = count(pdo_fetchall($ztdm2));
if($_GPC['op']=='dy'){
  $result=$this->qtPrint($_GPC['order_id']);
  message('打印成功！', $this->createWebUrl('dmorder'), 'success');


}

include $this->template('web/dmorder');