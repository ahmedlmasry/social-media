<?php
return [
    'attributes' => [
        'email' => 'البريد الإلكتروني',
        'username' => 'اسم المستخدم',
        'password' => 'كلمة المرور',
        'body' => 'محتوى التغريدة',
        'image' => 'صورة الملف الشخصي',

    ],
    'required' => 'حقل :attribute مطلوب.',
    'email' => 'يجب أن يكون :attribute عنوان بريد إلكتروني صالح.',
    'unique' => 'تم أخذ :attribute بالفعل.',
    'min' => [
        'string' => 'يجب أن يكون :attribute على الأقل :min أحرف.',
    ],
    'max' => [
        'string' => 'قد لا يزيد :attribute عن :max أحرف.',
    ],
    'no_spaces' => 'لا يمكن أن يحتوي :attribute على مسافات.',
    'password_rules' => 'يجب أن تحتوي :attribute على 8 أحرف على الأقل، بما في ذلك أحرف كبيرة وصغيرة وأرقام ورموز خاصة.',
    'image' => 'يجب أن يكون :attribute صورة (png, jpg, jpeg).',
    'max_size' => 'قد لا يزيد :attribute عن :max كيلوبايت.',
];
