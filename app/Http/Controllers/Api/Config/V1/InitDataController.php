<?php

namespace App\Http\Controllers\Api\Config\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Sys\SysConfig;
use App\Model\SingleObject\SinSysConfig;

class InitDataController extends Controller
{
    public function initdata(Request $request){

        $sys_config = SinSysConfig::getInstance();
        $name = $sys_config->getPlaceholder('wname');
        return $this->apiResponse(0,'success',$name);
    }
}
