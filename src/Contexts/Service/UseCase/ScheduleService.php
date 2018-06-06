<?php
declare(strict_types=1);

namespace Contexts\Service\UseCase;

use App\Infrastructure\Exception\UseCaseException;
use Contexts\Common\ValueObject\DateInterval;
use Contexts\Service\Model\Owner;
use Contexts\Service\Model\Schedule;
use Contexts\Service\Model\Service;
use Contexts\Service\Repository\ClientRepository;
use Contexts\Service\Repository\ServiceRepository;

class ScheduleService
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * @var ServiceRepository
     */
    private $serviceRepository;

    /**
     * ScheduleService constructor.
     * @param ClientRepository $clientRepository
     * @param ServiceRepository $serviceRepository
     */
    public function __construct(ClientRepository $clientRepository, ServiceRepository $serviceRepository)
    {
        $this->clientRepository = $clientRepository;
        $this->serviceRepository = $serviceRepository;
    }

    /**
     * @param int $serviceId
     * @param string $email
     * @param string $start
     * @param string $end
     * @return Service
     * @throws \App\Infrastructure\Exception\DomainModelException
     */
    public function handle(int $serviceId, string $email, string $start, string $end): Service
    {
        $client = $this->clientRepository->findClient($email);
        if (!$client) {
            throw new UseCaseException('client_must_exist');
        }

        $service = $this->serviceRepository->findService($serviceId);
        if (!$service) {
            throw new UseCaseException('invalid_service');
        }

        $schedule = new Schedule(new DateInterval(new \DateTime($start), new \DateTime($end)), $service);
        $service->addSchedule($schedule);

        $this->serviceRepository->update($service);

        return $service;
    }
}