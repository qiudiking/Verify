<?php
/**
 * Created by PhpStorm.
 * User: htpc
 * Date: 2018/3/20
 * Time: 10:50
 */

namespace AtServer;


use Log\Log;
use News\FormNews;
use AtServer\ErrorHandler;
use AtServer\VerifyException;
use Request\Request;

/**
 * 手机短信验证
 * Class MobileNewsVerify
 *
 * @package Verify
 */
class MobileNewsVerify implements Verify {
	/**
	 * @param \AtServer\VerifyRule $verifyRule
	 *
	 * @return bool|mixed
	 * @throws \AtServer\VerifyException
	 */
	public function doVerifyRule( VerifyRule $verifyRule ) {
		$verifyRule->chkDataType();
		$verifyRule->value=Request::get('_form_news');
		$mobile = Request::get('mobile');
		//Log::log($mobile);
		//Log::log($verifyRule->value);
		//Log::log('---------------------'.$verifyRule);
		if(!FormNews::checkNews($mobile,$verifyRule->value,true)){
			$verifyRule->error || $verifyRule->error= $verifyRule->getDes(). '无效' ;
			throw new VerifyException( ErrorHandler::VERIFY_FORM_HASH, $verifyRule->error );
		}
		return true;
	}
}