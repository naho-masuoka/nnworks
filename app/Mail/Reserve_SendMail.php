<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Reserve_SendMail extends Mailable
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
        ->from('works@schduler.com',$this->user['email_name'])
        ->subject($this->data['name'].'様　受付完了致しました。')
        ->view('emails.reserve.html')
        ->with(['data'=>$this->data,'user'=>$this->user,  'param'=>encrypt($param)]);
               
    }
}
