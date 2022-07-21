<?php

namespace App\Service;

use App\Manager\OrderManager;
use DateTime;
use Exception;
use Monolog\Logger;

class CreateOrder
{
    /**
     * @var array
     */
    private array $orderLine;

    /**
     * @var OrderManager
     */
    private OrderManager $orderManager;

    /**
     * @var Logger
     */
    private Logger $logger;

    public function __construct(OrderManager $orderManager, Logger $logger, array $orderLine = [])
    {
        $this->orderLine = $orderLine;
        $this->orderManager = $orderManager;
        $this->logger = $logger;
    }


    /**
     * @throws Exception
     */
    public function process()
    {
        $this->mergeAdditionalInfo();
        $this->campaignStartDateIsGreaterThanEndDate();
        $this->campaignHasProductLimit();
        $this->orderDeliveryStartDateIsGreaterThanEndDate();
        $this->orderDeliveryStartDateIsNotValid();
        $this->persistOrder();
    }

    public function addOrderLine(array $data)
    {
        $this->orderLine = $data;
    }

    private function mergeAdditionalInfo()
    {
        foreach ($this->orderLine['products'] as $i => $product) {
            try {
                $additionalInfo =
                    MysteriousService::requestProviderInformation(
                        $product['providerId']
                    )
                ;
                $this->orderLine['products'][$i] = array_merge($product, $additionalInfo);
            } catch (Exception $e) {
                $this->logger->info(
                    sprintf(
                        'Could not load provider for product "%s"',
                        $product['product_name']
                    )
                );
                $this->logger->error($e->getMessage());
            }
        }
    }

    /**
     * @throws Exception
     */
    private function campaignStartDateIsGreaterThanEndDate()
    {
        if (new DateTime($this->orderLine['campaign_start_date']) > new DateTime($this->orderLine['campaign_end_date'])) {
            throw new Exception('Campaign start date should be earlier than end date.');
        }
    }

    /**
     * @throws Exception
     */
    private function campaignHasProductLimit()
    {
        if (
            count($this->orderLine['products']) > $this->orderLine['campaign_product_limit']

        ) {
            throw new Exception(
                sprintf(
                    'This campaign can not accept more than %d products, %d given',
                    $this->orderLine['campaign_product_limit'],
                    count($this->orderLine['products'])
                )
            );
        }
    }

    /**
     * @throws Exception
     */
    private function orderDeliveryStartDateIsGreaterThanEndDate()
    {
        if (
            new DateTime($this->orderLine['delivery_start_date']) > new DateTime($this->orderLine['delivery_end_date'])
//            || !$this->orderLine['permanent_order']
        ) {
            throw new Exception('Campaign start date should be earlier than end date.');
        }
    }

    /**
     * @throws Exception
     */
    private function orderDeliveryStartDateIsNotValid()
    {
        if (new DateTime($this->orderLine['creation_date']) > new DateTime($this->orderLine['delivery_start_date'])) {
            throw new Exception('The order can not start delivering in the past.');
        }
    }

    /**
     * @throws Exception
     */
    private function persistOrder()
    {
        $this->orderManager->create($this->orderLine);
        $this->logger->info(
            sprintf(
                'Order created for customer "%s".',
                "
                    {$this->orderLine['customer_title']} 
                    {$this->orderLine['customer_first_name']} 
                    {$this->orderLine['customer_last_name']}
                "
            )
        );
    }
}