<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Reply_User_SendMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {    
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->from('works@schduler.com',$this->data['signature'])
        ->subject($this->data['name'].'様へ送信したメール 件名:' .$this->data['subject'])
        ->view('emails.reply.user_html')
        ->with('data', $this->data);
               
    }
}
