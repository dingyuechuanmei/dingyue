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
$item = pdo_fetch("SELECT a.*,b.name as table_name,c.name as type_name FROM ".tablename('wpdc_order'). " a"  . " left join " . tablename("wpdc_table") . " b on a.table_id=b.id  left join " . tablename("wpdc_table_type") ." c on b.type_id=c.id WHERE  a.id=:id", array(':id'=>$_GPC['id']));
$goods=pdo_getall('wpdc_goods',array('order_id'=>$_GPC['id']));
include $this->template('web/1dnorderinfo');