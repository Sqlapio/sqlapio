<?php

return [    
    "var"                          => 'http://web.sqlapio.net/pricing.html',
    "URL_REGISTER_USER_FORCE_SALE" => env('URL_REGISTER_USER_FORCE_SALE' !=null)?env('URL_REGISTER_USER_FORCE_SALE') :"http://localhost:8000/register-user-force-sale/",
    "URL_CORPORATE"                => env('URL_CORPORATE'!=null)?env('URL_CORPORATE'):"http://localhost:8000/register-user-corporate/",
    "URL_REGISTER_MEDICO"          => env('URL_REGISTER_MEDICO' !=null)? env('URL_REGISTER_MEDICO') :"http://localhost:8000/public/payment-form/null/",
];
