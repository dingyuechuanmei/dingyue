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
$item=pdo_get('wpdc_order',array('id'=>$_GPC['id']));
$goods=pdo_getall('wpdc_goods',array('order_id'=>$_GPC['id']));
//print_r($item);die;
include $this->template('web/1orderinfo');