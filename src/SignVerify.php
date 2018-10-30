<?php
/**
 * Created by PhpStorm.
 * User: pantian
 * Date: 2017/1/14 0014
 * Time: 12:16
 */

namespace AtServer;

use Cache\RedisCache;
use AtServer\ErrorHandler;
use AtServer\VerifyException;
use Request\Request;
use Sign\Sign;

/**
 * url签名校验
 * Class RequiredVerify
 *
 * @package Verify
 */
class SignVerify implements Verify {

	private $prefix = 'sign_verify_';

	/**
	 * @param \AtServer\VerifyRule $verifyRule
	 *
	 * @return bool|mixed
	 * @throws \AtServer\VerifyException
	 */
	public function doVerifyRule( VerifyRule $verifyRule ) {
		$verifyRule->chkDataType();
		$verifyRule->value=Request::get('_sign');

		if ( strlen($verifyRule->value)==0) {
			$verifyRule->error || $verifyRule->error= $verifyRule->getDes(). '为空' ;
			throw new VerifyException( ErrorHandler::VERIFY_REQUIRED, $verifyRule->error );
		}
		$key = $this->prefix . $verifyRule->value;
		$redis = RedisCache::instance();
		if(strlen($verifyRule->value)!=40){
			$verifyRule->error || $verifyRule->error= '签名长度不够40位' ;
			throw new VerifyException( ErrorHandler::SIGN_LENGTH_ERROR, $verifyRule->error );
		}
		Sign::Sign();
		if($redis->get($key)=='1'){
			$verifyRule->error || $verifyRule->error= '签名已被使用过' ;
			throw new VerifyException( ErrorHandler::SIGN_IS_USED, $verifyRule->error );
		}
		$verifyRule->ruleValue|| $verifyRule->ruleValue=7200;
		$redis->set( $key, 1, $verifyRule->ruleValue );

		return true;
	}

}