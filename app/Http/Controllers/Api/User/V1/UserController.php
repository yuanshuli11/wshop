<?php

namespace App\Http\Controllers\Api\User\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User\User;
use Webmozart\Assert\Assert;
use App\Model\Helper;
class UserController extends Controller
{
    public function add(){
        return $this->apiResponse(0,"success","调用成功了～");
    }

    public function login(Request $request){

        $phone_number = $request->get("phone");
        $password = $request->get("password");
        Helper::checkPhoneNumber($phone_number);
        $user = new User();
        $token = $user->setphone($phone_number)
             ->setPassword($password)
             ->login();

        return $this->apiResponse(0,'success',['token'=>$token]);
    }

    public function getUserInfo(){

    }

}
