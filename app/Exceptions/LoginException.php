<?php

namespace App\Exceptions;

use Exception;

class loginException extends Exception
{
    public $status=[
        1 => '登录失败',
        2=>'登录异常'
    ];
}
