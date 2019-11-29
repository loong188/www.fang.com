<?php

namespace App\Exceptions;

use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
//use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if($request->ajax()){
        if($exception instanceof ValidationException){
            return response()->json(['status'=> 1 ,'msg'=> '验证失败','data'=> $exception->validator->messages()],200);

        }
        return parent::render($request, $exception);
    }
        if($exception instanceof LoginException){
           $data=['status'=>$exception->getCode(),'msg'=>$exception->getMessage()];
            return response()->json($data,401);
        }elseif($exception instanceof MyValidateException){
            $data=['status'=>$exception->getCode(),'msg'=>$exception->getMessage()];
            return response()->json($data,401);
        }
        return parent::render($request, $exception);
    }

}
