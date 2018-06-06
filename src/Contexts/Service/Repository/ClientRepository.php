<?php
declare(strict_types=1);

namespace Contexts\Service\Repository;

use Contexts\Service\Model\Client;

interface ClientRepository
{
    /**
     * @param string $email
     * @return Client|null
     */
    public function findClient(string $email): ?Client;
}