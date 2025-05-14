<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Exception;

class EmailService
{
    /**
     * Gửi email sử dụng API miễn phí SendGrid
     */
    public function sendEmail($to, $subject, $body)
    {
        try {
            // Sử dụng SendGrid API (bạn cần đăng ký tài khoản miễn phí với SendGrid)
            // để có API key và thiết lập thông tin người gửi
            $apiKey = env('SENDGRID_API_KEY');
            $fromEmail = env('MAIL_FROM_ADDRESS', 'example@yourdomain.com');
            $fromName = env('MAIL_FROM_NAME', 'Laravel App');

            $client = new Client([
                'base_uri' => 'https://api.sendgrid.com/v3/',
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type' => 'application/json',
                ],
            ]);

            // Tạo dữ liệu gửi
            $data = [
                'personalizations' => [
                    [
                        'to' => [
                            ['email' => $to]
                        ],
                        'subject' => $subject,
                    ]
                ],
                'from' => [
                    'email' => $fromEmail,
                    'name' => $fromName
                ],
                'content' => [
                    [
                        'type' => 'text/html',
                        'value' => $this->formatEmailContent($subject, $body)
                    ]
                ],
                // Thiết lập chống spam
                'tracking_settings' => [
                    'subscription_tracking' => [
                        'enable' => true
                    ],
                    'open_tracking' => [
                        'enable' => true
                    ],
                    'click_tracking' => [
                        'enable' => true
                    ]
                ],
                'mail_settings' => [
                    'bypass_list_management' => [
                        'enable' => false
                    ],
                    'spam_check' => [
                        'enable' => true,
                        'threshold' => 5
                    ]
                ]
            ];

            // Gửi request đến SendGrid API
            $response = $client->post('mail/send', [
                'json' => $data
            ]);

            return $response->getStatusCode() == 202;
        } catch (Exception $e) {
            // Log lỗi nhưng không hiển thị cho người dùng
            Log::error('Email sending failed: ' . $e->getMessage());

            // Dự phòng: Sử dụng Mailgun nếu SendGrid thất bại
            return $this->sendEmailWithMailgun($to, $subject, $body);
        }
    }

    /**
     * Gửi email dự phòng sử dụng Mailgun API
     */
    protected function sendEmailWithMailgun($to, $subject, $body)
    {
        try {
            $apiKey = env('MAILGUN_API_KEY');
            $domain = env('MAILGUN_DOMAIN');
            $fromEmail = env('MAIL_FROM_ADDRESS', 'example@yourdomain.com');
            $fromName = env('MAIL_FROM_NAME', 'Laravel App');

            $client = new Client();

            $response = $client->post("https://api.mailgun.net/v3/{$domain}/messages", [
                'auth' => ['api', $apiKey],
                'form_params' => [
                    'from' => "{$fromName} <{$fromEmail}>",
                    'to' => $to,
                    'subject' => $subject,
                    'html' => $this->formatEmailContent($subject, $body),
                    'o:tracking' => 'yes',
                    'o:tracking-clicks' => 'yes',
                    'o:tracking-opens' => 'yes',
                    'h:X-Mailgun-Variables' => json_encode(['type' => 'verification']),
                    'v:type' => 'verification',
                ]
            ]);

            return $response->getStatusCode() == 200;
        } catch (Exception $e) {
            // Log lỗi
            Log::error('Backup email sending failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Định dạng nội dung email đẹp hơn để tránh spam
     */
    protected function formatEmailContent($subject, $body)
    {
        // Tạo mẫu HTML đơn giản để email trông chuyên nghiệp hơn
        return '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>' . htmlspecialchars($subject) . '</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    line-height: 1.6;
                    color: #333;
                    margin: 0;
                    padding: 0;
                }
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 20px;
                }
                .header {
                    text-align: center;
                    padding: 20px 0;
                    border-bottom: 1px solid #eee;
                }
                .logo {
                    max-width: 200px;
                    height: auto;
                }
                .content {
                    padding: 30px 0;
                }
                .code-container {
                    text-align: center;
                    padding: 15px;
                    background-color: #f9f9f9;
                    border-radius: 5px;
                    margin: 20px 0;
                }
                .code {
                    font-size: 24px;
                    font-weight: bold;
                    letter-spacing: 5px;
                    color: #0066cc;
                }
                .footer {
                    text-align: center;
                    padding-top: 20px;
                    font-size: 12px;
                    color: #777;
                    border-top: 1px solid #eee;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <img src="https://example.com/logo.png" alt="Logo" class="logo">
                </div>
                <div class="content">
                    <h2>' . htmlspecialchars($subject) . '</h2>
                    <p>' . nl2br(htmlspecialchars(preg_replace('/\b(\d{6})\b/', '<span class="code">$1</span>', $body))) . '</p>
                    <div class="code-container">
                        <p>Mã xác nhận của bạn:</p>
                        <div class="code">' . preg_replace('/\D/', '', $body) . '</div>
                    </div>
                    <p>Mã này sẽ hết hạn trong vòng 10 phút.</p>
                    <p>Nếu bạn không yêu cầu mã này, vui lòng bỏ qua email này.</p>
                </div>
                <div class="footer">
                    <p>© ' . date('Y') . ' Laravel App. Tất cả các quyền được bảo lưu.</p>
                    <p>Email này được gửi tự động, vui lòng không trả lời.</p>
                </div>
            </div>
        </body>
        </html>
        ';
    }
}
