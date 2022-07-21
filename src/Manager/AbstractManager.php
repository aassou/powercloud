<?php

namespace App\Manager;

use Doctrine\ORM\EntityManagerInterface;
use Monolog\Logger;

abstract class AbstractManager implements CrudManagerInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $entityManager;

    /**
     * @var Logger
     */
    protected Logger $logger;
}
