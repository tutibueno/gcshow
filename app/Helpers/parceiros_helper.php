<?php

if (! function_exists('parceiro_logo_url')) {
    function parceiro_logo_url(?string $logo): string
    {
        $logo = trim((string) $logo);

        if ($logo === '') {
            return base_url('public/logo.png');
        }

        if (preg_match('#^https?://#i', $logo) === 1) {
            return $logo;
        }

        if (str_starts_with($logo, 'public/')) {
            return base_url($logo);
        }

        if (str_starts_with($logo, 'uploads/parceiros/')) {
            return base_url('public/' . $logo);
        }

        return base_url('public/uploads/parceiros/' . ltrim($logo, '/'));
    }
}
