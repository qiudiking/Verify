<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/17 0017
 * Time: 下午 9:23
 */

namespace AtServer;




use AtServer\ErrorHandler;
use AtServer\VerifyException;

class InVerify implements Verify {
	/**
	 * @param \AtServer\VerifyRule $verifyRule
	 *
	 * @return bool|mixed
	 * @throws \AtServer\VerifyException
	 */
	public function doVerifyRule( VerifyRule $verifyRule ) {
		$verifyRule->chkDataType();
		$ruleValue = explode( ',', $verifyRule->ruleValue);
		if (!in_array($verifyRule->value,$ruleValue)) {
			$verifyRule->error || $verifyRule->error = $verifyRule->getDes(). '的值必须是'.$verifyRule->ruleValue.'这些';
			throw new VerifyException( ErrorHandler::VERIFY_BETWEEN_LENGTH,$verifyRule->error);
		}
		return true;
	}
}