<?php

namespace App\Libraries;

use App\Models\NewsletterSubscriberModel;
use Config\Services;

class NewsletterService
{
    public function subscribe(string $name, string $email): array
    {
        $model = new NewsletterSubscriberModel();
        $existing = $model->where('email', $email)->first();

        if ($existing) {
            return [
                'success' => false,
                'message' => 'Este e-mail já está cadastrado na newsletter.',
            ];
        }

        $token = bin2hex(random_bytes(24));

        $id = $model->insert([
            'name' => trim($name),
            'email' => strtolower(trim($email)),
            'status' => 'active',
            'token' => $token,
            'created_at' => date('Y-m-d H:i:s'),
        ], true);

        $subscriber = $model->find($id);
        $mailchimp = $this->subscribeToMailchimp($subscriber['email'], $subscriber['name']);

        return [
            'success' => true,
            'message' => 'Inscrição realizada com sucesso.',
            'subscriber' => $subscriber,
            'mailchimp' => $mailchimp,
        ];
    }

    public function unsubscribeByToken(string $token): array
    {
        $model = new NewsletterSubscriberModel();
        $subscriber = $model->where('token', $token)->first();

        if (!$subscriber) {
            return [
                'success' => false,
                'message' => 'Link de cancelamento inválido.',
            ];
        }

        if ($subscriber['status'] === 'unsubscribed') {
            return [
                'success' => true,
                'message' => 'Este e-mail já estava cancelado.',
                'subscriber' => $subscriber,
            ];
        }

        $model->update($subscriber['id'], ['status' => 'unsubscribed']);
        $this->unsubscribeFromMailchimp($subscriber['email']);

        return [
            'success' => true,
            'message' => 'Sua inscrição foi cancelada com sucesso.',
            'subscriber' => $subscriber,
        ];
    }

    public function subscribeToMailchimp(string $email, string $name): array
    {
        $apiKey = env('mailchimp.apiKey');
        $audienceId = env('mailchimp.audienceId');
        $serverPrefix = env('mailchimp.serverPrefix');

        if (!$apiKey || !$audienceId || !$serverPrefix) {
            return [
                'success' => false,
                'message' => 'Integração Mailchimp não configurada.',
            ];
        }

        $url = sprintf('https://%s.api.mailchimp.com/3.0/lists/%s/members', $serverPrefix, $audienceId);
        $payload = [
            'email_address' => $email,
            'status' => 'subscribed',
            'merge_fields' => [
                'FNAME' => $name,
            ],
        ];

        try {
            $response = Services::curlrequest()->request('POST', $url, [
                'auth' => ['anystring', $apiKey],
                'headers' => ['Content-Type' => 'application/json'],
                'body' => json_encode($payload),
                'http_errors' => false,
            ]);

            return [
                'success' => $response->getStatusCode() < 300,
                'status_code' => $response->getStatusCode(),
                'response' => $response->getBody(),
            ];
        } catch (\Throwable $e) {
            log_message('error', 'Mailchimp subscribe error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function unsubscribeFromMailchimp(string $email): array
    {
        $apiKey = env('mailchimp.apiKey');
        $audienceId = env('mailchimp.audienceId');
        $serverPrefix = env('mailchimp.serverPrefix');

        if (!$apiKey || !$audienceId || !$serverPrefix) {
            return [
                'success' => false,
                'message' => 'Integração Mailchimp não configurada.',
            ];
        }

        $subscriberHash = md5(strtolower($email));
        $url = sprintf('https://%s.api.mailchimp.com/3.0/lists/%s/members/%s', $serverPrefix, $audienceId, $subscriberHash);
        $payload = ['status' => 'unsubscribed'];

        try {
            $response = Services::curlrequest()->request('PATCH', $url, [
                'auth' => ['anystring', $apiKey],
                'headers' => ['Content-Type' => 'application/json'],
                'body' => json_encode($payload),
                'http_errors' => false,
            ]);

            return [
                'success' => $response->getStatusCode() < 300,
                'status_code' => $response->getStatusCode(),
                'response' => $response->getBody(),
            ];
        } catch (\Throwable $e) {
            log_message('error', 'Mailchimp unsubscribe error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }
}
