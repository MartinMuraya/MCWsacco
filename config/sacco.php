<?php

return [
    'registration_fee' => env('SACCO_REGISTRATION_FEE', 1000),
    'share_capital_price' => env('SACCO_SHARE_CAPITAL_PRICE', 1000),
    'minimum_monthly_contribution' => env('SACCO_MIN_CONTRIBUTION', 500),
    
    // Accounts structure
    'default_accounts' => [
        'shares' => 'Share Capital Account',
        'deposits' => 'Main Savings Account',
        'loans' => 'Loan Account',
        'penalties' => 'Penalty Account',
    ],
    
    // System limits
    'loan_guarantor_ratio' => env('SACCO_GUARANTOR_RATIO', 3), // max loan = savings * ratio
];
