<?php

return [

    'title' => 'دخول',

    'heading' => 'الدخول إلى حسابك',

    'buttons' => [

        'authenticate' => [
            'label' => 'تسجيل الدخول',
        ],

    ],

    'fields' => [

        'email' => [
            'label' => 'البريد الإلكتروني',
        ],

        'password' => [
            'label' => 'كلمة المرور',
        ],

        'remember' => [
            'label' => 'تذكرني',
        ],

    ],

    'messages' => [
        'failed' => 'خطأ في إدخال المعرف الخاص بك أو كلمة المرور',
        'throttled' => 'محاولات تسجيل دخول كثيرة جدًا. يرجى المحاولة مرة أخرى بعد:seconds ثواني.',
    ],

];
