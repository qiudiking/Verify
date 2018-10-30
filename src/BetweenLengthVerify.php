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
 * 长度范围校验
 * Class BetweenLengthVerify
 *
 * @package Verify
 */
class BetweenLengthVerify implements Verify {
	/**
	 * @param \AtServer\VerifyRule $verifyRule
	 *
	 * @return bool|mixed
	 * @throws \AtServer\VerifyException
	 */
	public function doVerifyRule( VerifyRule $verifyRule ) {
		$verifyRule->chkDataType();
		$len = mb_strlen( $verifyRule->value );
		list( $min, $max ) = explode( ',', $verifyRule->ruleValue);
		$verifyRule->minValue = $min;
		$verifyRule->maxValue = $max;

		if ( $len< (float) $verifyRule->minValue|| $len> (float) $verifyRule->maxValue) {
			$verifyRule->error || $verifyRule->error = $verifyRule->getDes(). '的长度必须在' . $verifyRule->minValue . '~' . $verifyRule->maxValue. '之间';
			throw new VerifyException( ErrorHandler::VERIFY_BETWEEN_LENGTH,$verifyRule->error);
		}
		return true;
	}

}