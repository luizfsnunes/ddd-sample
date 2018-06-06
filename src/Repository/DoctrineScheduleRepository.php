<?php
declare(strict_types=1);

namespace App\Repository;

use Contexts\Service\Repository\ScheduleRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class DoctrineScheduleRepository extends ServiceEntityRepository implements ScheduleRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ScheduleRepository::class);
    }
}