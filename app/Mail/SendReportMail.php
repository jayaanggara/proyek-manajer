<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendReportMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $data;

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
        $email =  $this->view('emails.send-report')->with([
            'project_name' => $this->data->proyek->project_name,
            'description' => $this->data->description,
        ]);
        
        foreach ($this->data->files as $item) { 
            $email->attachFromStorageDisk('public', $item->name);
        }

        return $email;
    }
}
