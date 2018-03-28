<?php
/**
 * Created by PhpStorm.
 * User: yuanshuli
 * Date: 2018/3/28
 * Time: 下午2:37
 */

namespace App\Model\SingleObject;
use Illuminate\Support\Facades\Redis;
use App\Model\Sys\SysConfig;
use Webmozart\Assert\Assert;

class SinSysConfig
{
    use Single;
    private $data = [];

    public function getPlaceholder($placeholder){
        if(empty($this->data[$placeholder])){
            $redis_key = 'sysconfig'.$placeholder;
            if(Redis::exists($redis_key)){
                $this->data[$placeholder] = Redis::get($redis_key);
            }else{
                $SysConfig  = SysConfig::select('content')->where('placeholder',$placeholder)->where('status',0)->first()->toArray();
                Assert::keyExists($SysConfig,'content',$placeholder.' 不存在');
                $this->data[$placeholder]  = $SysConfig['content'];
                Redis::set($redis_key,$this->data[$placeholder]);
                Redis::expire($redis_key,config('default_config.config_expire_time'));
            }
        }
        return json_decode($this->data[$placeholder]);
    }


}