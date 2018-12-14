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
$list = pdo_getall('wpdc_table_type',array('uniacid' => $_W['uniacid'],'seller_id'=>$storeid), array() , '' , 'orderby ASC');
if($_GPC['id']){
		$result = pdo_delete('wpdc_table_type', array('id'=>$_GPC['id']));
		if($result){
			message('删除成功',$this->createWebUrl('tabletype2',array()),'success');
		}else{
		message('删除失败','','error');
		}
	}


include $this->template('web/tabletype2');