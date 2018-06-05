<?php
declare(strict_types=1);

namespace App\Infrastructure\DomainEvent;

abstract class Event
{
    /**
     * @return string
     */
    abstract public function getEventName(): string;
}