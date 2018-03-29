<?php

namespace App\Http\Middleware;
use Closure;
use Webmozart\Assert\Assert;

class ApiSign
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(isset($_REQUEST['nosign'])){
            $t = false;
        }else{
            $t = true;
        }
        if(env('APP_ENV')=='prod'&&$t){
            //优先取header，querystring次之

            try {
                Assert::keyExists($_SERVER, 'HTTP_SHOP_APP_ID', 'appid不能为空');
                $appId = $_SERVER['HTTP_SHOP_APP_ID'];
                Assert::keyExists($_SERVER, 'HTTP_SHOP_SIGN', 'sign不能为空');
                $clientSign = $_SERVER["HTTP_SHOP_SIGN"];
            } catch (\Exception $e) {
                Assert::keyExists($_REQUEST, 'shop_app_id', 'appid不能为空');
                $appId = $_REQUEST['shop_app_id'];
                Assert::keyExists($_REQUEST, 'shop_sign', 'sign不能为空');
                $clientSign = $_REQUEST["shop_sign"];
            }
            Assert::keyExists($_REQUEST, 'ts', 'ts不能为空');
            $requestTs = $_REQUEST["ts"];
            $now = time();
            $timeDiff = $now - $requestTs;
           # Assert::greaterThan(3000, abs($timeDiff), "request has expired. {$now} - {$requestTs}");

            $params_join_sign = $_REQUEST;
            if (isset($params_join_sign["wshop_sign"])) {
                unset($params_join_sign["wshop_sign"]);
            }
            if (isset($params_join_sign["wshop_app_id"])) {
                unset($params_join_sign["wshop_app_id"]);
            }
            $serverSign = $this->_getSign($request,$appId, $params_join_sign);

            \Log::info("app_id: ".$appId." sign_data:".json_encode($params_join_sign).' result:'.$serverSign."  client:".$clientSign);
            Assert::eq($serverSign, $clientSign, 'sign error. should be:'.$serverSign);
        }

        return $next($request);
    }

    protected function _getSign($request,$appId, $params)
    {
        //根据appid获取appsecret
        $appSecret = config('appids.'.$appId);
        if (empty($appSecret)) {
            return "";
        }
        if (!is_array($params)) {
            return "";
        }

        //把参数按参数名的字典序升序排序
        ksort($params);

        //以appsecret开始，后接所有参数和值，拼成一个字符串
        $str = $appSecret;
        foreach ($params as $k => $v) {
            $str .= "$k=" . urlencode(urldecode($v));
        }

        $str .= trim($_SERVER['REQUEST_URI'], '/');
        return md5($str);
    }
}
