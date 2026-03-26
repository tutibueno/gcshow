<?php

namespace App\Controllers;

use App\Libraries\NewsletterService;

class Newsletter extends BaseController
{
    public function index()
    {
        return view('newsletter/index');
    }

    public function subscribe()
    {
        $name = trim((string) $this->request->getPost('name'));
        $email = strtolower(trim((string) $this->request->getPost('email')));
        $consent = $this->request->getPost('consent_lgpd');

        if ($name === '' || $email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->with('newsletter_error', 'Informe nome e e-mail válidos.');
        }

        if (!$consent) {
            return redirect()->back()->with('newsletter_error', 'Você precisa aceitar o consentimento LGPD.');
        }

        $service = new NewsletterService();
        $result = $service->subscribe($name, $email);

        if (!$result['success']) {
            return redirect()->back()->with('newsletter_error', $result['message']);
        }

        return redirect()->back()->with('newsletter_success', $result['message']);
    }

    public function unsubscribe(string $token)
    {
        $result = (new NewsletterService())->unsubscribeByToken($token);

        return view('newsletter/unsubscribe_result', [
            'success' => $result['success'],
            'message' => $result['message'],
        ]);
    }
}
