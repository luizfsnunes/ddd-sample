<?php
declare(strict_types=1);

namespace Contexts\Service\Repository;

use Contexts\Service\Model\Service;

interface ServiceRepository
{
    /**
     * @param Service $service
     * @return Service
     */
    public function create(Service $service): Service;

    /**
     * @param Service $service
     * @return Service
     */
    public function update(Service $service): Service;

    /**
     * @param int $id
     * @return Service|null
     */
    public function findService(int $id): ?Service;
}