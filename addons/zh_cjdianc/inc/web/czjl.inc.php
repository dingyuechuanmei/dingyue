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
$pageindex = max(1, intval($_GPC['page']));
$pagesize=15;
$sql="select a.* ,b.name,b.img from " . tablename("cjdc_qbmx") . " a"  . " left join " . tablename("cjdc_user") . " b on b.id=a.user_id"." where ( a.note='充值赠送' || a.note='后台充值' || a.note='在线充值' ) and b.uniacid = :uniacid order by a.id DESC";
$select_sql =$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
$list = pdo_fetchall($select_sql,array(':uniacid'=>$_W['uniacid']));	   
$total=pdo_fetchcolumn("select count(*) from " . tablename("cjdc_qbmx") . " a"  . " left join " . tablename("cjdc_user") . " b on b.id=a.user_id where ( a.note='充值赠送' || a.note='后台充值' || a.note='在线充值' ) and b.uniacid = :uniacid",array(':uniacid'=>$_W['uniacid']));
$pager = pagination($total, $pageindex, $pagesize);
include $this->template('web/czjl');