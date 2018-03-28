<?php
/**
 * Created by PhpStorm.
 * User: yuanshuli
 * Date: 2018/3/28
 * Time: 下午9:28
 */

namespace App\Model;


use Webmozart\Assert\Assert;

class Helper
{
    public static function checkPhoneNumber($phone){
        if(!preg_match("/^1[34578]\d{9}$/", $phone)){
            Assert::eq(1,2,'phone error');
        }
    }

    public  static function getPassword($password){
        return md5(env('PASSWORD_ADD').$password);
    }


}