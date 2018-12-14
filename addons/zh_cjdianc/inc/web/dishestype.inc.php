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
$list = pdo_getall('cjdc_type',array('uniacid' => $_W['uniacid'],'store_id'=>$storeid), array() , '' , 'order_by ASC');
if($_GPC['op']=='del'){
	$rst=pdo_getall('cjdc_goods',array('type_id'=>$_GPC['id']));
		if(!$rst){
		$result = pdo_delete('cjdc_type', array('id'=>$_GPC['id']));
		if($result){
			message('删除成功',$this->createWebUrl('dishestype',array()),'success');
		}else{
		message('删除失败','','error');
		}
	}else{
		message('该分类下有菜品无法删除','','error');
	}
}
if($_GPC['op']=='upd'){
	$res=pdo_update('cjdc_type',array('is_open'=>$_GPC['state']),array('id'=>$_GPC['id']));
	if($res){
			message('修改成功',$this->createWebUrl('dishestype',array()),'success');
		}else{
		message('修改失败','','error');
		}
}

include $this->template('web/dishestype');