<?php
declare(strict_types=1);

namespace Contexts\User\Repository;

use Contexts\User\Model\User;

interface UserRepository
{
    /**
     * @param User $user
     * @return mixed
     */
    public function createUser(User $user);

    /**
     * @param string $email
     * @return User
     */
    public function findByEmail(string $email): ?User;
}