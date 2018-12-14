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
$res3=pdo_get("wpdc_signset",array('uniacid'=>$_W['uniacid']));
$list=pdo_getall('wpdc_continuous',array('uniacid'=>$_W['uniacid']));
$res2=pdo_get('wpdc_special',array('uniacid'=>$_W['uniacid']));
include $this->template('web/integral');