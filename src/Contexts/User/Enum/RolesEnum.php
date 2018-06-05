<?php
declare(strict_types=1);

namespace Contexts\User\Enum;

class RolesEnum
{
    public const CLIENT = 'client';
    public const SERVICE_OWNER = 'service_owner';

    /**
     * @param string $profile
     * @return bool
     */
    public static function validate(string $profile): bool
    {
        return \in_array($profile, [self::CLIENT, self::SERVICE_OWNER], true);
    }
}