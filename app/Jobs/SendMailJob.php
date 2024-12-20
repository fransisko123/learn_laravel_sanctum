<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailJob implements ShouldQueue
{
    use Queueable;

    public $email;
    public $subject;
    public $message;

    /**
     * Create a new job instance.
     */
    public function __construct($email, $subject, $message)
    {
        $this->email = $email;
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Kirim email menggunakan Mail facade
        Mail::raw($this->message, function ($mail) {
            $mail->to($this->email)
                 ->subject($this->subject);
        });
    }
}
