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
        $param = [
            'id'    => $this->data['id'],
            'email' => $this->data['email'],
        ];
        
        return $this
        ->from('example@example.com',$this->data['signature'])
        ->subject($this->data['name'].'様　受付完了致しました。')
        ->view('emails.reserve.html')
        ->with(['data'=>$this->data, 'param'=>encrypt($param)]);
               
    }
}
