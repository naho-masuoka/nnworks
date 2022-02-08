<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Title;

class Cancel_User_SendMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;
    protected $title;
    protected $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$title,$user)
    {    
        $this->data = $data;
        $this->title = $title;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->from('example@example.com',$this->user['email_name'])
        ->subject($this->data['name'].'様が講座をキャンセルをしました。')
        ->view('emails.cancel.user_html')
        ->with(['data'=>$this->data,'title'=>$this->title]);
               
    }
}
