<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Cancel_SendMail extends Mailable
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
        $param = [
            'id'    => $this->data['id'],
            'email' => $this->data['email'],
        ];
        
        return $this
        ->from('works@schduler.com',$this->user['email_name'])
        ->subject($this->data['name'].'様　キャンセルを承りました。')
        ->view('emails.cancel.html')
        ->with(['data'=>$this->data, 'title'=>$this->title, 'param'=>encrypt($param)]);
               
    }
}
