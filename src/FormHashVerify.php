<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/14 0014
 * Time: 12:16
 */

namespace AtServer;

use AtServer\ErrorHandler;
use AtServer\VerifyException;


/**
 * 表单Hash校验
 * Class FormHashVerify
 *
 * @package Verify
 */
class FormHashVerify implements Verify {
	/**
	 * @param \AtServer\VerifyRule $verifyRule
	 *
	 * @return bool|mixed
	 * @throws \AtServer\VerifyException
	 */
	public function doVerifyRule( VerifyRule $verifyRule ) {
		$verifyRule->chkDataType();
		if(!FormHash::verifyHash($verifyRule->value,true)){
			$verifyRule->error || $verifyRule->error= $verifyRule->getDes(). '请求无效' ;
			throw new VerifyException( ErrorHandler::VERIFY_FORM_HASH, $verifyRule->error );
		}
		return true;
	}

}