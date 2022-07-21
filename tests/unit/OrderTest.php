<?php

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class OrderTest extends ApiTestCase
{
    const EXPECTED_JSON_RESPONSE = '
        {
            "@context": "string",
            "@id": "string",
            "@type": "string",
            "customerTitle": "string",
            "customerFirstName": "string",
            "customerLastName": "string",
            "customerEmail": "string",
            "campaignTitle": "string",
            "campaignSummary": "string",
            "campaignStartDate": "2022-07-21T08:35:10.837Z",
            "campaignEndDate": "string",
            "campaignProductLimit": 0,
            "campaignSpecial": true,
            "deliveryStartDate": "2022-07-21T08:35:10.837Z",
            "deliveryEndDate": "2022-07-21T08:35:10.837Z",
            "permanentOrder": true,
            "products": [
                "string"
            ],
            "id": 0,
            "created": "2022-07-21T08:35:10.837Z",
            "createdBy": "string",
            "updated": "2022-07-21T08:35:10.838Z",
            "updatedBy": "string",
            "isPublished": true
        }
    ';

    /**
     * @var UnitTester
     */
    protected UnitTester $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function testGetOrderById(): void
    {
        // When
        static::createClient()->request('GET', '/api/orders/1');

        // Then
        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame(
            'content-type', 'application/ld+json; charset=utf-8'
        );

        $this->assertJsonContains(self::EXPECTED_JSON_RESPONSE);
    }

    // tests

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function testGetAllOrders(): void
    {
        // When
        $response = static::createClient()->request('GET', '/api/orders')->toArray();

        // Then
        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame(
            'content-type', 'application/ld+json; charset=utf-8'
        );

        $this->assertArrayHasKey('hydra:member', $response);
        $this->assertEquals('/api/contexts/Order', $response["@context"]);
        $this->assertEquals('/api/orders', $response["@id"]);
        $this->assertEquals('hydra:Collection', $response["@type"]);
        $this->assertGreaterThan(0, $response["hydra:totalItems"]);
        $this->assertCount(5, $response["hydra:member"]);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function testPagination(): void
    {
        // When
        $response = static::createClient()->request('GET', '/api/orders/3')->toArray();

        // Then
        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame(
            'content-type', 'application/ld+json; charset=utf-8'
        );

        $this->assertEquals('/api/contexts/Order', $response["@context"]);
        $this->assertEquals('/api/orders/3', $response["@id"]);
        $this->assertEquals('Order', $response["@type"]);
        $this->assertIsArray($response["orders"]);
        $this->assertGreaterThan(0, $response["orders"]);
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testGetOrderByIdFailure(): void
    {
        // When order with id 5555 does not exist
        static::createClient()->request('GET', '/api/orders/5555');
        // Then HTTP Error 404 is returned
        $this->assertResponseStatusCodeSame(404);
    }
}

