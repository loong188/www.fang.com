<?php

namespace App\Observers;

use App\Models\FangOwner;
use Illuminate\Mail\Message;
use Mail;
use App\Jobs\FangOwnerJob;

class FangOwnerOberver
{
    /**
     * Handle the fang owner "created" event.
     *
     * @param  \App\Models\FangOwner  $fangOwner
     * @return void
     */
    public function created(FangOwner $fangOwner)
    {
        $email=$fangOwner->email;
        $name=$fangOwner->name;
        $data=['name'=>$name,'email'=>$email];
        //投递任务
        dispatch(new FangOwnerJob($data));
//        Mail::raw('添加您的信息成功，稍后会有我们的工作人员联系您',function (Message $message) use ($email,$name){
//            $message->subject('信息添加通知邮件');
//            $message->to($email,$name);
//        });
    }


}
