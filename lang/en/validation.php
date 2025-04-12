<?php
return [
    'attributes' => [
        'email' => 'email',
        'username' => 'username',
        'password' => 'password',
        'body' => 'tweet content',
        'image' => 'profile image',
    ],
    'required' => 'The :attribute field is required.',
    'email' => 'The :attribute must be a valid email address.',
    'unique' => 'The :attribute has already been taken.',
    'min' => [
        'string' => 'The :attribute must be at least :min characters.',
    ],
    'max' => [
        'string' => 'The :attribute may not be greater than :max characters.',
    ],
    'no_spaces' => 'The :attribute cannot contain spaces.',
    'password_rules' => 'The :attribute must contain at least 8 characters, including uppercase, lowercase, numbers and special characters.',
    'image' => 'The :attribute must be an image (png, jpg, jpeg).',
    'max_size' => 'The :attribute may not be greater than :max kilobytes.',
];
