<?php
declare(strict_types=1);

namespace App\Infrastructure\DomainEvent;

class EventRecorder
{
    /**
     * @var array
     */
    private $events;

    protected function __construct()
    {

    }

    /**
     * @return EventRecorder
     */
    public static function getInstance(): self
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
        }

        return $instance;
    }

    /**
     * @param Event $event
     */
    public function record(Event $event): void
    {
        $this->events[$event->getEventName()] = $event;
    }

    /**
     * @return array
     */
    public function pullEvents(): array
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }
}