<?php
/**
 * 本程序由残风社区源码论坛提供
 *
 * www.92php.net
 * 
 * QQQ466421811  承接微擎模块破解、小程序前端、PHP解密
 */


global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
$uniacid=$_W['uniacid'];
$user_id=$_GPC['user_id'];
$where=" where uniacid={$uniacid} and user_id={$user_id}";
if($_GPC['time']){
  $start=$_GPC['time']['start'];
  $end=$_GPC['time']['end'];
  $where.=" and cerated_time >='{$start}' and cerated_time<='{$end}'";
}
$pageindex = max(1, intval($_GPC['page']));
$pagesize=10;
$sql="select *  from " . tablename("cjdc_integral") ." ".$where." order by id DESC";
$select_sql =$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
$list = pdo_fetchall($select_sql);	   
$total=pdo_fetchcolumn("select count(*) from " . tablename("cjdc_integral") ." ".$where);
$pager = pagination($total, $pageindex, $pagesize);
include $this->template('web/hyuserjf');