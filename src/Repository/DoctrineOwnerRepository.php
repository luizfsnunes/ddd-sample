<?php
declare(strict_types=1);

namespace App\Repository;

use Contexts\Service\Model\Owner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Contexts\Service\Repository\OwnerRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class DoctrineOwnerRepository extends ServiceEntityRepository implements OwnerRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Owner::class);
    }

    /**
     * @param string $email
     * @return Owner|null
     */
    public function findOwner(string $email): ?Owner
    {
        return $this->findOneBy(['email' => $email, 'role' => 'service_owner']);
    }
}