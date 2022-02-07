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
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$title)
    {    
        $this->data = $data;
        $this->title = $title;
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
        ->from('example@example.com',$this->data['signature'])
        ->subject($this->data['name'].'様　キャンセルを承りました。')
        ->view('emails.cancel.html')
        ->with(['data'=>$this->data, 'title'=>$this->title, 'param'=>encrypt($param)]);
               
    }
}
