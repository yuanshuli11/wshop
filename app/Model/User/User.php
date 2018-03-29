<?php

namespace App\Model\User;

use App\Model\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;
use Webmozart\Assert\Assert;


class User extends Model
{

    public function setphone($phone){
        $this->phone = $phone;
        return $this;

    }
    public function setPassword($password){
        Assert::notEmpty($this->phone,'should setphone first');
        $this->password = Helper::getPassword($password);
        $userinfo = self::where("phone",$this->phone)->where("password",$this->password)->first();
        Assert::notEmpty($userinfo,'手机号或密码错误');
        $this->userInfo = $userinfo->toArray();
        return $this;
    }

    public function login(){
        Assert::notEmpty($this->userInfo,'no userinfo');
        Assert::keyExists($this->userInfo,'id','no userinfo');
        $token =md5(json_encode($this->userInfo).rand(0,10000).time());
        Redis::set($token,$this->userInfo['phone']);
        Redis::expire($token,config('default_config.login_expire_time'));

        return $token;
    }

    public static function checkToken($token){
        if(Redis::exists($token)){
            Redis::expire($token,config('default_config.login_expire_time'));
        }else{
            Assert::eq(0,1,'token error');
        }
    }

}
