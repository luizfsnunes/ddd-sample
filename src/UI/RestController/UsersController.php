<?php
declare(strict_types=1);

namespace App\UI\RestController;

use Contexts\User\UseCase\CreateUser;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends FOSRestController
{
    /**
     * @Rest\Post("api/users")
     * @Rest\View(
     *     statusCode=201,
     *     serializerGroups={"secure"},
     * )
     *
     * @param Request $request
     * @param CreateUser $createUser
     * @return Response
     * @throws \App\Infrastructure\Exception\DomainModelException
     */
    public function createUser(Request $request, CreateUser $createUser)
    {
        $response = $createUser->handle(
            $request->get('name'),
            $request->get('email'),
            $request->get('password'),
            $request->get('role')
        );

        return $response;
    }
}