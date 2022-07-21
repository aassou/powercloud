<?php

namespace App\Manager;

use App\Entity\Order;
use App\Entity\Product;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class OrderManager extends AbstractManager
{
    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param array $data
     * @return mixed
     * @throws Exception
     */
    public function create(array $data): mixed
    {
        $order = new Order();
        $order->setCustomerTitle($data['customer_title']);
        $order->setCustomerFirstName($data['customer_firstname']);
        $order->setCustomerLastName($data['customer_lastname']);
        $order->setCustomerEmail($data['email']);
        $order->setCampaignTitle($data['campaign_title']);
        $order->setCampaignSummary($data['campaign_summary']);
        $order->setCampaignStartDate(new DateTime($data['campaign_start_date']));
        $order->setCampaignEndDate($data['campaign_end_date']);
        $order->setCampaignProductLimit($data['campaign_product_limit']);
        $order->setCampaignSpecial($data['campaign_special']);
        $order->setCreated(new DateTime($data['creation_date']));
        $order->setDeliveryStartDate(new DateTime($data['delivery_start_date']));
        $order->setDeliveryEndDate(new DateTime($data['delivery_end_date']));
        $order->setPermanentOrder($data['permanent_order']);

        foreach ($data['products'] as $datum) {
            $product = new Product();
            $product->setName($datum['product_name']);
            $product->setPrice($datum['product_price']);
            $product->setType($datum['product_type']);
            $product->setProviderId($datum['providerId']);

            $order->addProduct($product);
        }

        $this->entityManager->persist($order);
        $this->entityManager->flush();
    }

    public function read(int $id): mixed
    {
        // TODO: Implement read() method.
    }

    public function update(array $data, int $id): mixed
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id): void
    {
        // TODO: Implement delete() method.
    }

    public function readAll(): mixed
    {
        // TODO: Implement readAll() method.
    }
}