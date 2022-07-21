<?php

namespace App\Service;

use Exception;

class MysteriousService
{
    /**
     * @throws Exception
     */
    public static function requestProviderInformation(int $id)
    {
        if (random_int(0, 10) > 3) {
            return [
                'number' => '000000',
                'sub_number' => '99999',
                'area_number' => '8888'
            ];
        }

        throw new Exception(
            sprintf('Could not load information for provider id %d', $id),
            1
        );
    }
}