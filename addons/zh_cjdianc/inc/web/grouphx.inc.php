<?php
/**
 * 本程序由残风社区源码论坛提供
 *
 * www.92php.net
 * 
 * QQQ466421811  承接微擎模块破解、小程序前端、PHP解密
 */


global $_GPC, $_W;
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$GLOBALS['frames'] = $this->getMainMenu2();
$storeid=$_COOKIE["storeid"];
$cur_store = $this->getStoreById($storeid);

$strwhere = '';
$pindex = max(1, intval($_GPC['page']));
$psize = 10;
$list = pdo_fetchall("SELECT a.*,b.name,b.openid,b.img FROM " . tablename('cjdc_grouphx') ." a left join" .tablename('cjdc_user')." b on a.hx_id=b.id WHERE a.store_id = :store_id  ORDER BY a.id DESC LIMIT
    " . ($pindex - 1) * $psize . ',' . $psize, array(':store_id' =>$storeid));

if (!empty($list)) {
    $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('cjdc_grouphx')." a left join" .tablename('cjdc_user')." b on a.hx_id=b.id WHERE a.store_id = :store_id", array(':store_id' => $storeid));
    $pager = pagination($total, $pindex, $psize);
}
if($_GPC['op']=='delete'){
		$res4=pdo_delete("cjdc_grouphx",array('id'=>$_GPC['id']));
		if($res4){
		 message('删除成功！', $this->createWebUrl('grouphx'), 'success');
		}else{
			  message('删除失败！','','error');
		}
	}
include $this->template('web/grouphx');