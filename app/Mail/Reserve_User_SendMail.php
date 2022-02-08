<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Reserve_User_SendMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;
    protected $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$user)
    {    
        $this->data = $data;
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
        ->from('works@schduler.com',$this->user['email_name'])
        ->subject($this->data['name'].'様より予約を受付ました。')
        ->view('emails.reserve.user_html')
        ->with('data', $this->data);
               
    }
}
