<?php
/**
 * 本程序由残风社区源码论坛提供
 *
 * www.92php.net
 * 
 * QQQ466421811  承接微擎模块破解、小程序前端、PHP解密
 */


global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu2();
$storeid=$_COOKIE["storeid"];
$cur_store = $this->getStoreById($storeid);
$info=pdo_get('cjdc_storeset',array('store_id'=>$storeid));
if(checksubmit('submit')){
	$data['is_yydc']=$_GPC['is_yydc'];
	$res = pdo_update('cjdc_storeset', $data, array('store_id' => $storeid));
	if($res){
		message('编辑成功',$this->createWebUrl('yyset',array()),'success');
	}else{
		message('编辑失败','','error');
	}
}
include $this->template('web/yyset');