<?php
declare(strict_types=1);

namespace Contexts\Service\Repository;

use Contexts\Service\Model\Owner;

interface OwnerRepository
{
    /**
     * @return Owner|null
     */
    public function findOwner(string $email): ?Owner;
}