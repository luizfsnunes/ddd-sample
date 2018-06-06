<?php
declare(strict_types=1);

namespace Contexts\User\UseCase;

use App\Infrastructure\Exception\UseCaseException;
use Contexts\User\Model\User;
use Contexts\User\Repository\UserRepository;
use Contexts\User\ValueObject\Role;

class CreateUser
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * CreateUser constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @param string $role
     * @return User
     * @throws \App\Infrastructure\Exception\DomainModelException
     */
    public function handle(string $name, string $email, string $password, string $role): User
    {
        if ($this->userRepository->findByEmail($email)) {
            throw new UseCaseException('email_already_registered');
        }

        $user = new User($name, $email, $password, new Role($role));
        $this->userRepository->createUser($user);

        return $user;
    }
}