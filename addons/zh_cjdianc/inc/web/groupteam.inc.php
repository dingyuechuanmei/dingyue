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
$cur_store = $this->getStoreById($storeid);
$GLOBALS['frames'] = $this->getMainMenu2();

$where=" where uniacid=:uniacid and store_id=:store_id";
$data[':uniacid']=$_W['uniacid']; 
$data[':store_id']=$_COOKIE["storeid"];
$sql=" select a.*,b.name as nick_name,b.img from".tablename('cjdc_group')." a left join ".tablename('cjdc_user')." b on a.user_id=b.id where a.id=:id";
$group=pdo_fetch($sql,array(':id'=>$_GPC['id']));
$sql2=" select a.*,b.name as nick_name from".tablename('cjdc_grouporder')." a left join ".tablename('cjdc_user')." b on a.user_id=b.id where a.group_id=:id";
$order=pdo_fetchall($sql2,array(':id'=>$_GPC['id']));


include $this->template('web/groupteam');