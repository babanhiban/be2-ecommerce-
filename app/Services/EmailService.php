<?php

namespace App\Services;

use App\Mail\SendGridTestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log; // Thêm dòng này để sử dụng Log

class EmailService
{
    /**
     * Gửi email sử dụng Mailable.
     */
    public function sendEmail($to)
    {
        try {
            // Gửi email bằng SendGridTestMail Mailable
            Mail::to($to)->send(new SendGridTestMail());

            return true;
        } catch (\Exception $e) {
            // Log lỗi nếu gửi thất bại
            Log::error('Email sending failed: ' . $e->getMessage()); // Sửa lại ở đây
            return false;
        }
    }
}
