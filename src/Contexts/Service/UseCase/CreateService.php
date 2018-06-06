<?php
declare(strict_types=1);

namespace Contexts\Service\UseCase;

use App\Infrastructure\Exception\UseCaseException;
use Contexts\Service\Model\Owner;
use Contexts\Service\Model\Service;
use Contexts\Service\Repository\OwnerRepository;
use Contexts\Service\Repository\ServiceRepository;

class CreateService
{
    /**
     * @var OwnerRepository
     */
    private $ownerRepository;

    private $serviceRepository;

    /**
     * CreateService constructor.
     * @param OwnerRepository $ownerRepository
     * @param ServiceRepository $serviceRepository
     */
    public function __construct(OwnerRepository $ownerRepository, ServiceRepository $serviceRepository)
    {
        $this->ownerRepository = $ownerRepository;
        $this->serviceRepository = $serviceRepository;
    }

    /**
     * @param string $name
     * @param string $email
     * @return Service
     */
    public function handle(string $name, string $email): Service
    {
        $owner = $this->ownerRepository->findOwner($email);
        if (!$owner) {
            throw new UseCaseException('owner_must_exist');
        }

        $service = new Service($name, $owner);
        $this->serviceRepository->create($service);

        return $service;
    }
}