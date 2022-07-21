<?php

use App\Tests\api\AbstractOrderCest;
use Codeception\Util\HttpCode;

class CreateOrderCest extends AbstractOrderCest
{
    public function _before(ApiTester $I)
    {
        $this->prepareHeader($I);
    }

    public function successful_order_creation_via_api(ApiTester $I)
    {
        $I->wantToTest('A successful Order Creation via API');
        $I->sendPost(
            AbstractOrderCest::VALID_URL,
            AbstractOrderCest::VALID_JSON_REQUEST_BODY
        );
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
    }

    public function notfound_order_creation_via_api(ApiTester $I)
    {
        $I->wantToTest('A bad routing Order Creation via API');
        $I->sendPost(
            AbstractOrderCest::INVALID_URL,
            AbstractOrderCest::VALID_JSON_REQUEST_BODY
        );
        $I->seeResponseCodeIsClientError();
        $I->dontSeeResponseCodeIs(HttpCode::OK);
    }

    public function invalid_body_request_order_creation_via_api(ApiTester $I)
    {
        $I->wantToTest('An invalid Request Body Order Creation via API');
        $I->sendPost(
            AbstractOrderCest::VALID_URL,
            AbstractOrderCest::INVALID_JSON_REQUEST_BODY
        );
        $I->seeResponseCodeIsClientError();
        $I->dontSeeResponseCodeIs(HttpCode::OK);
    }
}
