<?php

namespace App\Tests\api;

use ApiTester;
use App\Utils\PowerOptions;

class AbstractOrderCest
{
    const VALID_URL = '/orders';
    const INVALID_URL = '/orderr';
    const VALID_JSON_REQUEST_BODY = [
        'customer_title' => 'Miss',
        'customer_firstname' => 'Jane',
        'customer_lastname' => 'Doe',
        'email' => 'jane@doe.com',
        'campaign_title' => 'Standard Basic Package',
        'campaign_summary' => 'Pickup to ...',
        'campaign_start_date' => '2020-01-01',
        'campaign_end_date' => '2025-12-31',
        'campaign_product_limit' => 2,
        'campaign_special' => false,
        'products' => [
            [
                'product_name' => 'RasPower',
                'product_type' => PowerOptions::POWER,
                'product_price' => 0.023,
                'providerId' => 112233
            ],
            [
                'product_name' => 'HeatFamilyVer',
                'product_type' => PowerOptions::GAS,
                'product_price' => 0.00455,
                'providerId' => 332211
            ],
            [
                'product_name' => 'HeatFamilyVer2',
                'product_type' => PowerOptions::GAS,
                'product_price' => 0.0055,
                'providerId' => 342211
            ]
        ],
        "created" => "2022-05-16T14:32:56.020Z",
        "createdBy" => "admin",
        "updated" => "2022-05-16T14:32:56.020Z",
        "updatedBy" => "admin",
        "isPublished" => true
    ];
    const INVALID_JSON_REQUEST_BODY = [
        'customer_title' => 'Miss',
        'customer_firstname' => 'Jane',
        'customer_lastname' => 'Doe',
        'email' => 'jane@doe.com',
        'campaign_title' => 'Standard Basic Package',
        'campaign_summary' => 'Pickup to ...',
        'campaign_start_date' => '2020-01-01',
        'campaign_end_date' => '2025-12-31',
        'campaign_product_limit' => 2,
        'campaign_special' => false,
        'products' => [
            [
                'product_name' => 'RasPower',
                'product_type' => PowerOptions::POWER,
                'product_price' => 0.023,
                'providerId' => 112233
            ],
            [
                'product_name' => 'HeatFamilyVer',
                'product_type' => PowerOptions::GAS,
                'product_price' => 0.00455,
                'providerId' => 332211
            ],
            [
                'product_name' => 'HeatFamilyVer2',
                'product_type' => PowerOptions::GAS,
                'product_price' => 'xol',
                'providerId' => 342211
            ]
        ],
        "created" => "2022-05-16T14:32:56.020Z",
        "createdBy" => "admin",
        "updated" => "2022-05-16T14:32:56.020Z",
        "updatedBy" => "admin",
        "isPublished" => true
    ];

    public function prepareHeader(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/ld+json');
        $I->haveHttpHeader('accept', 'application/ld+json');
    }
}