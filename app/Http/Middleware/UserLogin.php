<?php

namespace App\Http\Middleware;

use Closure;
use Webmozart\Assert\Assert;
use App\Model\User\User;

class UserLogin
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

        try {
            Assert::keyExists($_SERVER, 'HTTP_SHOP_TOKEN', 'SHOP-TOKEN不能为空');
            $token = $_SERVER['HTTP_SHOP_TOKEN'];
        } catch (\Exception $e) {
            Assert::keyExists($_REQUEST, 'token', 'token不能为空');
            $token = $_REQUEST['token'];
        }
        User::checkToken($token);
        return $next($request);
    }
}
