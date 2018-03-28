<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public  static function apiResponse($status = 0 , $message = '' , $data='')
    {
        return response()->json(['status' => $status, 'message'=>$message ,'values' => $data], 200, [], JSON_UNESCAPED_UNICODE);
    }
    public function apiAccident($data)
    {
        return response()->json(['status' => 1, 'message'=>'不知道哪里出了问题哦~' ,'values' =>$data ], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
