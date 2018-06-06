<?php
declare(strict_types=1);

namespace App\Repository;

use Contexts\User\Model\User;
use Contexts\User\Repository\UserRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class DoctrineUserRepository extends ServiceEntityRepository implements UserRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function createUser(User $user)
    {
        $this->_em->persist($user);
        $this->_em->flush();
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User
    {
        return $this->findOneBy(['email' => $email]);
    }
}