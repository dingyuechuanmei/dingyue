<?php
/**
 * 本程序由残风社区源码论坛提供
 *
 * www.92php.net
 * 
 * QQQ466421811  承接微擎模块破解、小程序前端、PHP解密
 */


global $_GPC, $_W;
$action = 'start';
$uid=$_COOKIE["uid"];
$storeid=$_COOKIE["storeid"];
$cur_store = $this->getStoreById($storeid);
$GLOBALS['frames'] = $this->getNaveMenu($storeid, $action,$uid);
$list=pdo_getall('cjdc_dytag',array('store_id'=>$storeid,'uniacid'=>$_W['uniacid']),array(),'','sort asc');
if($_GPC['id']){
	$result = pdo_delete('cjdc_dytag', array('id'=>$_GPC['id']));
		if($result){
			message('删除成功',$this->createWebUrl2('dlprintlabel',array()),'success');
		}else{
			message('删除失败','','error');
		}
}
include $this->template('web/dlprintlabel');