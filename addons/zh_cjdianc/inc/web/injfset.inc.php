<?php
/**
 * 本程序由残风社区源码论坛提供
 *
 * www.92php.net
 * 
 * QQQ466421811  承接微擎模块破解、小程序前端、PHP解密
 */


global $_GPC, $_W;
$storeid=$_COOKIE["storeid"];
$cur_store = $this->getStoreById($storeid);
$GLOBALS['frames'] = $this->getMainMenu2();
$info=pdo_get('wpdc_store',array('uniacid'=>$_W['uniacid'],'id'=>$storeid));
    if(checksubmit('submit')){
            $data['is_jf']=$_GPC['is_jf'];
            $data['is_yyjf']=$_GPC['is_yyjf'];
            $data['is_wmjf']=$_GPC['is_wmjf'];
            $data['is_dnjf']=$_GPC['is_dnjf'];
            $data['is_dmjf']=$_GPC['is_dmjf'];
            $data['is_yuejf']=$_GPC['is_yuejf'];
                $res = pdo_update('wpdc_store', $data, array('id' => $_GPC['id']));
                if($res){
                    message('编辑成功',$this->createWebUrl('injfset',array()),'success');
                }else{
                    message('编辑失败','','error');
                }
           
        }
include $this->template('web/injfset');