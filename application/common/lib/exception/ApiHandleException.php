<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/9 0009
 * Time: 18:39
 */
namespace app\common\lib\exception;

use Exception;
use think\exception\Handle;

class  ApiHandleException extends Handle{

    /**
     * @name Http状态码
     * @var int
     */
    public $httpCode=500;

    //重新定义输出格式
    public function render(Exception $e)
    {
        if(config("app_debug")==true){
            return parent::render($e);
        }
        if ($e instanceof ApiException) {
            $this->httpCode = $e->httpCode;
        }
        return show(0,$e->getMessage(),[],$this->httpCode);
    }
}