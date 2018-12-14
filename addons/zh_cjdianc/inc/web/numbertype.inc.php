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

if($_GPC['op']=='del'){
	$result = pdo_delete('cjdc_numbertype', array('id'=>$_GPC['id']));
		if($result){
			message('删除成功',$this->createWebUrl('numbertype',array()),'success');
		}else{
			message('删除失败','','error');
		}
}

$sql="select * from " . tablename("cjdc_numbertype")." where uniacid={$_W['uniacid']} and store_id={$storeid} order by sort asc";
$list=pdo_fetchall($sql);	


include $this->template('web/numbertype');