<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use App\Models\Member;
use Mail;

class SendEmail implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     *邮件队列
     * @return void
     */
    public function handle()
    {
        $data = []; //传递给视图的参数

        Mail::send('mails.message', $data, function($message) use($data){
            $message->from('szdch@126.com');
            $message->to($this->email)->subject( '欢迎注册我们的网站，请激活您的账号！');
        });
    }
}
