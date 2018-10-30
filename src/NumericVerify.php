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
 * 数值校验类
 * Class NumericVerify
 *
 * @package Verify
 */
class NumericVerify implements Verify {
	/**
	 * @param \AtServer\VerifyRule $verifyRule
	 *
	 * @return bool|mixed
	 * @throws \AtServer\VerifyException
	 */
	public function doVerifyRule( VerifyRule $verifyRule ) {
		$verifyRule->chkDataType();
		if ( !is_numeric($verifyRule->value)) {
			$verifyRule->error || $verifyRule->error= $verifyRule->getDes(). '不是有效的数值' ;
			throw new VerifyException( ErrorHandler::VERIFY_NUMBER, $verifyRule->error );
		}

		return true;
	}

}