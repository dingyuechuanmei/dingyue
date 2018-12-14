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

$list=pdo_getall('cjdc_coupons',array('uniacid' => $_W['uniacid'],'is_hy'=>1));
if($_GPC['id']){
	$result = pdo_delete('cjdc_coupons', array('id'=>$_GPC['id']));
	pdo_delete('cjdc_usercoupons',array('coupon_id'=>$_GPC['id']));
	if($result){
		message('删除成功',$this->createWebUrl('coupons',array()),'success');
	}else{
		message('删除失败','','error');
	}
}
include $this->template('web/hycoupons');