<?php

namespace App\Helpers;

class Helper {
    static function getKnowHowColumnsDetails()
    {
        return [
            [
                'image' => '/assets/images/homepage/electronic-2.png',
                'title' => __('text.pages.electronic.title'),
                'subtitle' => __('text.pages.electronic.subtitle'),
                'link' => route('electronic'),
                'copy' => __('text.pages.electronic.short_description'),
            ],
            [
                'image' => '/assets/images/homepage/microcontroller-2.png',
                'title' => __('text.pages.microcontroller.title'),
                'subtitle' => __('text.pages.microcontroller.subtitle'),
                'link' => route('microcontrollers'),
                'copy' => __('text.pages.microcontroller.short_description'), 
            ],
            [
                'image' => '/assets/images/homepage/linux-2.png', 
                'title' => __('text.pages.linux.title'),
                'subtitle' => __('text.pages.linux.subtitle'),
                'link' => route('linux'),
                'copy' => __('text.pages.linux.short_description'),  
            ]
        ];
    }
}