<?php

namespace Modus\Support;

use Illuminate\Support\Facades\Session;

class Flash
{
    public static function make(string $title,string $message,string $type = 'info'): void {
        $toasts = Session::get('modus::toasts', []);

        $toasts[] = [
            'id' => uniqid(),
            'title' => $title,
            'message' => $message,
            'type' => $type,
        ];

        Session::put('modus::toasts', $toasts);
    }
}