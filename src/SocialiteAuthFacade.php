<?php

namespace Kaiyum2012\SocialiteAuth;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Kaiyum2012\SocialiteAuth\Skeleton\SkeletonClass
 */
class SocialiteAuthFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'socialite-auth';
    }
}
