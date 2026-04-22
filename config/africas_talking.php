<?php

return [
    'username' => env('AT_USERNAME', 'sandbox'),
    'api_key' => env('AT_API_KEY', ''),
    'sender_id' => env('AT_SENDER_ID', ''), // Sender ID provided by AT
    
    // Testing and debug
    'sandbox' => env('AT_SANDBOX', true),
];
