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
$list=pdo_getall('cjdc_czhd',array('uniacid'=>$_W['uniacid']));
include $this->template('web/chongzhi');