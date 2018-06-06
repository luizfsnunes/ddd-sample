<?php
declare(strict_types=1);

namespace Contexts\Service\Model;

use Contexts\Common\ValueObject\DateInterval;

class Schedule
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var DateInterval
     */
    private $interval;

    /**
     * @var Service
     */
    private $service;

    /**
     * Schedule constructor.
     * @param DateInterval $interval
     * @param Service $service
     */
    public function __construct(DateInterval $interval, Service $service)
    {
        $this->interval = $interval;
        $this->service = $service;
    }

    /**
     * @return DateInterval
     */
    public function getInterval(): DateInterval
    {
        return $this->interval;
    }
}