<?php
/**
 * @Author: Marte
 * @Date:   2018-07-30 17:20:18
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-08-21 11:45:01
 */
define('IN_SYS', true);
require '../framework/bootstrap.inc.php';
global $_GPC;

function signature($data,$token){
	$timestamp	=	(string)$data['timestamp'];
	$eventId	=	(string)$data['eventId'];
	$params		=	array($token,$timestamp,$eventId);

	sort($params,SORT_STRING);
	$str	=	implode('',$params);

	$requestSignature	=	hash('sha256',$str);

	return $requestSignature;

}

$token = 'wweVn26oANvZoB';

if(isset($_GPC) && count($_GPC)>0){
	//将对方传递的信息写入文件
	$myfile = fopen("test.txt", "w");
	$str = '';

	foreach ($_GPC['__input'] as $key => $value) {
		if(is_array($value)){
			foreach ($value as $k => $v) {
				$str .= $key.'=>'.$k . '=' . $v."\r\n";
			}
		}else{
			$str .= $key . '=' . $value."\r\n";
		}

	}

	fwrite($myfile,$str);
	fclose($myfile);
}

if(isset($_GPC['eventId'])){

	if(time()-$_GPC['timestamp']>30){
		return false;
	}

	$requestSignature	=	signature($_GPC,$token);

	if($requestSignature === $_GPC['signature']){
		echo json_encode(['echoback'=>$_GPC['__input']['echoback']]);
		exit;
	}else{
		return false;
	}
}



