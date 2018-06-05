<?php
declare(strict_types=1);

namespace Contexts\User\Model;

use App\Infrastructure\DomainEvent\EventRecorder;
use Contexts\Common\Model\Identity;
use Contexts\User\Enum\RolesEnum;
use Contexts\User\Event\CreatedClientEvent;
use Contexts\User\Event\CreatedServiceOwnerEvent;
use Contexts\User\ValueObject\Role;

class User
{
    /**
     * @var Identity
     */
    private $identity;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var Role
     */
    private $role;

    /**
     * User constructor.
     * @param Identity $identity
     * @param string $name
     * @param string $email
     * @param string $password
     * @param Role $role
     */
    public function __construct(Identity $identity, string $name, string $email, string $password, Role $role)
    {
        $this->identity = $identity;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;

        switch ($this->role) {
            case RolesEnum::CLIENT:
                EventRecorder::getInstance()->record(new CreatedClientEvent($name, $name));
                break;

            case RolesEnum::SERVICE_OWNER:
                EventRecorder::getInstance()->record(new CreatedServiceOwnerEvent($name, $name));
                break;
        }
    }

    /**
     * @return Identity
     */
    public function getIdentity(): Identity
    {
        return $this->identity;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return Role
     */
    public function getRole(): Role
    {
        return $this->role;
    }
}