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
 * 最小值校验类
 *
 * 实列
 * "rule":"min","val":"0"
 *
 *
 * Class MinVerify
 *
 * @package Verify
 */
class MinVerify implements Verify {
	/**
	 * @param \AtServer\VerifyRule $verifyRule
	 *
	 * @return mixed|void
	 * @throws \AtServer\VerifyException
	 */
	public function doVerifyRule( VerifyRule $verifyRule ) {
		$verifyRule->chkDataType();

		$verifyRule->value=floatval( $verifyRule->value );
		if ( floatval( $verifyRule->ruleValue    ) >  $verifyRule->value) {
			$verifyRule->error || $verifyRule->error= $verifyRule->getDes(). '不能小于' . $verifyRule->ruleValue;
			throw new VerifyException( ErrorHandler::VERIFY_MIN, $verifyRule->error );
		}
	}

}