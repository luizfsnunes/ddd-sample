<?php
declare(strict_types=1);

namespace Contexts\Common\ValueObject;

use App\Infrastructure\Exception\DomainModelException;

class DateInterval
{
    /**
     * @var \DateTime
     */
    private $initial;

    /**
     * @var \DateTime
     */
    private $final;

    /**
     * DateInterval constructor.
     * @param \DateTime $initial
     * @param \DateTime $final
     * @throws DomainModelException
     */
    public function __construct(\DateTime $initial, \DateTime $final)
    {
        if ($initial > $final) {
            throw new DomainModelException('initial_date_greater_than_final_date');
        }

        $this->final = $final;
        $this->initial = $initial;
    }

    /**
     * @return \DateTime
     */
    public function getInitial(): \DateTime
    {
        return $this->initial;
    }

    /**
     * @return \DateTime
     */
    public function getFinal(): \DateTime
    {
        return $this->final;
    }
}