<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsletterSubscriberModel extends Model
{
    protected $table = 'newsletter_subscribers';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'status', 'token', 'created_at'];
    protected $useTimestamps = false;

    public function search(?string $term)
    {
        $builder = $this->orderBy('id', 'DESC');

        if ($term === null || trim($term) === '') {
            return $builder;
        }

        return $builder
            ->groupStart()
            ->like('name', $term)
            ->orLike('email', $term)
            ->groupEnd();
    }
}
