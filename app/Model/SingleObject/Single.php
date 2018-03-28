<?php
/**
 * Created by PhpStorm.
 * User: yuanshuli
 * Date: 2018/3/28
 * Time: 下午2:32
 */

namespace App\Model\SingleObject;

trait Single
{
    static private $instance;

    public static function getInstance($config=''){
        if(!self::$instance instanceof self){
            if($config){
                self::$instance =  new self($config);
            }else{
                self::$instance = new self();
            }
        }
        return self::$instance;
    }

    private function __clone(){
    }
}