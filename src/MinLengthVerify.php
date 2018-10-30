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
 * 最小长度校验类
 * Class MinLengthVerify
 *
 * @package Verify
 */
class MinLengthVerify implements Verify {
	/**
	 * @param \AtServer\VerifyRule $verifyRule
	 *
	 * @return bool|mixed
	 * @throws \AtServer\VerifyException
	 */
	public function doVerifyRule( VerifyRule $verifyRule ) {
		$verifyRule->chkDataType();
		if ( intval( $verifyRule->ruleValue) > mb_strlen( $verifyRule->value ) ) {
			$verifyRule->error || $verifyRule->error= $verifyRule->getDes(). '长度不能小于' . $verifyRule->ruleValue.'个字符';
			throw new VerifyException( ErrorHandler::VERIFY_MIN_LENGTH, $verifyRule->error );
		}

		return true;
	}

}