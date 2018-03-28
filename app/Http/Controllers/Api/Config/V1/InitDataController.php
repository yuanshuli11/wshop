<?php

namespace App\Http\Controllers\Api\Config\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Sys\SysConfig;
use App\Model\SingleObject\SinSysConfig;
class InitDataController extends Controller
{
    public function initdata(){
        $name  = SysConfig::where('placeholder','wname')->where('status',0)->get();
       # SinSysConfig::getInstance();

        return $this->apiResponse(0,'success',$name);
    }
}
