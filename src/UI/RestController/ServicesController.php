<?php
declare(strict_types=1);

namespace App\UI\RestController;

use Contexts\Service\UseCase\CreateService;
use Contexts\Service\UseCase\ScheduleService;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class ServicesController extends FOSRestController
{
    /**
     * @Rest\View(
     *     statusCode=201
     * )
     * @Rest\Post("api/services")
     *
     * @param Request $request
     * @param CreateService $createUser
     * @return \Contexts\Service\Model\Service
     */
    public function createService(Request $request, CreateService $createUser)
    {
        $response = $createUser->handle(
            $request->get('name'),
            $request->get('owner')
        );

        return $response;
    }

    /**
     * @Rest\View(
     *     statusCode=201
     * )
     * @Rest\Post("api/services/schedule")
     *
     * @param Request $request
     * @param ScheduleService $scheduleService
     * @return \Contexts\Service\Model\Service
     * @throws \App\Infrastructure\Exception\DomainModelException
     */
    public function scheduleService(Request $request, ScheduleService $scheduleService)
    {
        $response = $scheduleService->handle(
            (int) $request->get('id'),
            $request->get('client'),
            $request->get('start'),
            $request->get('end')
        );

        return $response;
    }
}