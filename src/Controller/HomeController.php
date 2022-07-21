<?php

namespace App\Controller;

use App\Service\CreateOrder;
use App\Utils\PowerOptions;
use Exception;
use Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @var CreateOrder
     */
    private CreateOrder $createOrder;

    /**
     * @var Logger
     */
    private Logger $logger;

    public function __construct(CreateOrder $createOrder, Logger $logger)
    {
        $this->createOrder = $createOrder;
        $this->logger = $logger;
    }

    /**
     * @return Response
     * @throws Exception
     */
    #[Route('/', methods: 'GET')]
    public function index(): Response
    {
        $orderData = [
            'customer_title' => 'Miss',
            'customer_firstname' => 'Jane',
            'customer_lastname' => 'Doe',
            'email' => 'jane@doe.com',
            'campaign_title' => 'Standard Basic Package',
            'campaign_summary' => 'Pickup to ...',
            'campaign_start_date' => '2020-01-01',
            'campaign_end_date' => '2025-12-31',
            'campaign_product_limit' => 4,
            'campaign_special' => false,
            'delivery_start_date' => '2022-05-01',
            'delivery_end_date' => '2023-05-01',
            'creation_date' => '2021-04-01',
            'permanent_order' => false,
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
            ]
        ];

        $this->createOrder->addOrderLine($orderData);
        $this->createOrder->process();

        return $this->redirectToRoute('api_entrypoint');
    }
}