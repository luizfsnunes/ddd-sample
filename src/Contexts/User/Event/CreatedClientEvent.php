<?php
declare(strict_types=1);

namespace Contexts\User\Event;

use App\Infrastructure\DomainEvent\Event;

class CreatedClientEvent extends Event
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * CreatedClientEvent constructor.
     * @param string $name
     * @param string $email
     */
    public function __construct(string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
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

    public function getEventName(): string
    {
        return 'user.created_client';
    }
}