<?php
declare(strict_types=1);

namespace Contexts\Service\Model;

use App\Infrastructure\Exception\DomainModelException;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Service
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var ArrayCollection
     */
    private $schedules;

    /**
     * @var Owner
     */
    private $owner;

    /**
     * Service constructor.
     * @param string $name
     * @param Owner $owner
     */
    public function __construct(string $name, Owner $owner)
    {
        $this->name = $name;
        $this->owner = $owner;
        $this->schedules = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Collection
     */
    public function getSchedules(): Collection
    {
        return $this->schedules;
    }

    /**
     * @return Owner
     */
    public function getOwner(): Owner
    {
        return $this->owner;
    }

    /**
     * @param Schedule $schedules
     * @throws DomainModelException
     */
    public function addSchedule(Schedule $schedules): void
    {
        if ($this->schedules) {
            $overlapped = $this->schedules->filter(function (Schedule $item) use ($schedules) {
                return ($schedules->getInterval()->getFinal()->getTimestamp() >= $item->getInterval()->getInitial()->getTimestamp()) ||
                    ($item->getInterval()->getFinal()->getTimestamp() >= $schedules->getInterval()->getInitial()->getTimestamp());
            })->count();

            if ($overlapped > 0) {
                throw new DomainModelException('overlapped_with_existing_schedule');
            }
        }

        $this->schedules->add($schedules);
    }
}