<?php

namespace App\Services;

use AfricasTalking\SDK\AfricasTalking;
use App\Models\SmsLog;
use Illuminate\Support\Facades\Log;

class SmsService
{
    private $username;
    private $apiKey;
    private $senderId;

    public function __construct()
    {
        $this->username = config('africas_talking.username');
        $this->apiKey = config('africas_talking.apiKey');
        $this->senderId = config('africas_talking.sender_id');
    }

    /**
     * Send an SMS to a phone number using Africa's Talking
     *
     * @param string $phone
     * @param string $message
     * @param int|null $userId
     * @return bool
     */
    public function send(string $phone, string $message, $userId = null): bool
    {
        // Format phone number to E.164 if needed (assuming Kenya +254)
        $phone = $this->formatPhoneNumber($phone);

        $log = SmsLog::create([
            'recipient_phone' => $phone,
            'message_body' => $message,
            'status' => 'queued',
            'created_by' => $userId,
        ]);

        if (empty($this->username) || empty($this->apiKey)) {
            Log::warning("Africa's Talking credentials not configured. SMS not sent.", ['phone' => $phone]);
            $log->update(['status' => 'failed', 'provider_response' => ['error' => 'Missing Credentials']]);
            return false;
        }

        try {
            $AT = new AfricasTalking($this->username, $this->apiKey);
            $sms = $AT->sms();

            $options = [
                'to'      => $phone,
                'message' => $message,
            ];

            if (!empty($this->senderId)) {
                $options['from'] = $this->senderId;
            }

            $response = $sms->send($options);

            if ($response['status'] === 'success') {
                $log->update([
                    'status' => 'sent',
                    'provider_response' => $response,
                    'sent_at' => now(),
                ]);
                return true;
            } else {
                $log->update([
                    'status' => 'failed',
                    'provider_response' => $response,
                ]);
                return false;
            }
        } catch (\Exception $e) {
            Log::error("SMS Sending failed: " . $e->getMessage());
            $log->update([
                'status' => 'failed',
                'provider_response' => ['error' => $e->getMessage()],
            ]);
            return false;
        }
    }

    private function formatPhoneNumber(string $phone): string
    {
        // Remove spaces, dashes, etc.
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // Convert 07... to +2547...
        if (str_starts_with($phone, '0')) {
            $phone = '+254' . substr($phone, 1);
        } elseif (str_starts_with($phone, '254')) {
            $phone = '+' . $phone;
        }

        return $phone;
    }
}
