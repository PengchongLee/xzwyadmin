<?php 

namespace app\common\services;

class BaseService
{
	protected static $_error_msg = null;
	protected static $_error_code = null;

	public static function  _err( $msg ='', $code = -1 )
	{
		self:: $_error_msg = $msg;
		self:: $_error_code = $code;
		return false;
	}

	 public static function getLastErrorMsg(){
        return self::$_error_msg?self::$_error_msg:"";
    }

    public static function getLastErrorCode(){
        return self::$_error_code?self::$_error_code:0;
    }
	

	
}


 ?>