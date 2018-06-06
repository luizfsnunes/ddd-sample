<?php
declare(strict_types=1);

namespace App\Repository;

use Contexts\Service\Model\Client;
use Contexts\Service\Repository\ClientRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class DoctrineClientRepository extends ServiceEntityRepository implements ClientRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Client::class);
    }

    /**
     * @param string $email
     * @return Client|null
     */
    public function findClient(string $email): ?Client
    {
        return $this->findOneBy(['email' => $email, 'role' => 'client']);
    }
}