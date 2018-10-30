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
 * 必填校验
 * Class RequiredVerify
 *
 * @package Verify
 */
class RequiredVerify implements Verify {
	/**
	 * @param \AtServer\VerifyRule $verifyRule
	 *
	 * @return bool|mixed
	 * @throws \AtServer\VerifyException
	 */
	public function doVerifyRule( VerifyRule $verifyRule ) {
		$verifyRule->chkDataType();
		if ( strlen($verifyRule->value)==0) {
			$verifyRule->error || $verifyRule->error= $verifyRule->getDes(). '不能为空' ;
			throw new VerifyException( ErrorHandler::VERIFY_REQUIRED, $verifyRule->error );
		}

		return true;
	}

}