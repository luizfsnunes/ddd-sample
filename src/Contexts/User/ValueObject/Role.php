<?php
declare(strict_types=1);

namespace Contexts\User\ValueObject;

use App\Infrastructure\Exception\DomainModelException;
use Contexts\User\Enum\RolesEnum;

class Role
{
    /**
     * @var string
     */
    private $role;

    /**
     * Role constructor.
     * @param string $role
     */
    public function __construct(string $role)
    {
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     * @throws DomainModelException
     */
    public function setRole(string $role): void
    {
        if (!RolesEnum::validate($role)) {
            throw new DomainModelException('invalid_role_name');
        }

        $this->role = $role;
    }
}