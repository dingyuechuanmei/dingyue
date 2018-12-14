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
$info=pdo_get('cjdc_system',array('uniacid'=>$_W['uniacid']));
    if(checksubmit('submit')){
            $data['dada_key']=trim($_GPC['dada_key']);
            $data['dada_secret']=trim($_GPC['dada_secret']);
            $res = pdo_update('cjdc_system', $data, array('id' => $_GPC['id']));
            if($res){
                message('编辑成功',$this->createWebUrl('dasettings',array()),'success');
            }else{
                message('编辑失败','','error');
            }
           
    }
include $this->template('web/dasettings');