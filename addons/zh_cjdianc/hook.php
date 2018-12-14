<?php
/**
 * 本程序由残风社区源码论坛提供
 *
 * www.92php.net
 * 
 * QQQ466421811  承接微擎模块破解、小程序前端、PHP解密
 */


/**
 * 微商城公告模块插件定义
 *
 * @author 微擎团队
 * @url
 */
defined('IN_IA') or exit('Access Denied');

class Zh_cjdianc_plugin_jfshopModule extends WeModuleHook {
	public function hookMobileNotice() {
		global $_W;

	echo 123;die;
		$notice = pdo_getcolumn('shopping_notice', array('uniacid' => $_W['uniacid']), 'content');
		include $this->template('notice');
	}
}