<?php
declare(strict_types=1);

namespace App\Repository;

use Contexts\Service\Model\Owner;
use Contexts\Service\Model\Service;
use Contexts\Service\Repository\ServiceRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Contexts\Service\Repository\OwnerRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class DoctrineServiceRepository extends ServiceEntityRepository implements ServiceRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Service::class);
    }

    /**
     * @param Service $service
     * @return Service
     */
    public function create(Service $service): Service
    {
        $this->_em->persist($service);
        $this->_em->flush();

        return $service;
    }

    /**
     * @param Service $service
     * @return Service
     */
    public function update(Service $service): Service
    {
        $this->_em->merge($service);
        $this->_em->flush();

        return $service;
    }

    public function findService(int $id): ?Service
    {
        return $this->find($id);
    }
}