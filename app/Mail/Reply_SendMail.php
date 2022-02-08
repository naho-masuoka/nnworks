<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Reply_SendMail extends Mailable
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
        $param = [
            'id'    => $this->data['id'],
            'email' => $this->data['email'],
        ];
        return $this
        ->from('works@schduler.com',$this->data['signature'])
        ->subject($this->data['subject'])
        ->view('emails.reply.html')
        ->with(['data'=>$this->data,'user'=>$this->user,'param'=>encrypt($param)]);
               
    }
}
