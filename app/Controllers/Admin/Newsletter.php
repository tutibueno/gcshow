<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\NewsletterSubscriberModel;

class Newsletter extends BaseController
{
    public function index()
    {
        $term = trim((string) $this->request->getGet('q'));
        $model = new NewsletterSubscriberModel();

        return view('admin/newsletter/index', [
            'term' => $term,
            'subscribers' => $model->search($term)->findAll(),
        ]);
    }

    public function exportCsv()
    {
        $term = trim((string) $this->request->getGet('q'));
        $subscribers = (new NewsletterSubscriberModel())->search($term)->findAll();

        $filename = 'newsletter-subscribers-' . date('Ymd-His') . '.csv';
        $handle = fopen('php://temp', 'w+');
        fputcsv($handle, ['ID', 'Nome', 'Email', 'Status', 'Token', 'Criado em'], ';');

        foreach ($subscribers as $subscriber) {
            fputcsv($handle, [
                $subscriber['id'],
                $subscriber['name'],
                $subscriber['email'],
                $subscriber['status'],
                $subscriber['token'],
                $subscriber['created_at'],
            ], ';');
        }

        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);

        return $this->response
            ->setHeader('Content-Type', 'text/csv; charset=UTF-8')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->setBody("\xEF\xBB\xBF" . $csv);
    }

    public function updateStatus(int $id)
    {
        $status = (string) $this->request->getPost('status');
        if (!in_array($status, ['active', 'unsubscribed'], true)) {
            return redirect()->back();
        }

        (new NewsletterSubscriberModel())->update($id, ['status' => $status]);
        return redirect()->to('/admin/newsletter');
    }

    public function delete(int $id)
    {
        (new NewsletterSubscriberModel())->delete($id);
        return redirect()->to('/admin/newsletter');
    }
}
