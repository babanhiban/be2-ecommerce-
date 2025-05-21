<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Markdown;

class SendGridTestMail extends Mailable
{
    use Queueable;

    public $subject = 'SendGrid Test';
    public $body = 'Test email from SendGrid!';

    /**
     * Tạo một instance của email.
     *
     * @return void
     */
    public function __construct()
    {
        // Có thể truyền dữ liệu động vào constructor nếu cần.
    }

    /**
     * Build thông tin email.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
            ->view('emails.test_email')  // Chỉ định view email
            ->with([
                'body' => $this->body,
            ]);
    }
}
