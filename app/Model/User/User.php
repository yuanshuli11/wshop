<?php

namespace App\Model\User;

use App\Model\Helper;
use Illuminate\Database\Eloquent\Model;
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
        $userinfo = self::where("phone",$this->phone)->where("password",$this->password)->first()->toArray();
        $this->userInfo = $userinfo;
        return $this;
    }

    public function login(){
        Assert::notEmpty($this->userInfo,'should get first');
        Assert::keyExists($this->userInfo,'')

    }


}
