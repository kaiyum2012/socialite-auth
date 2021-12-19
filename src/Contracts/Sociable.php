<?php

namespace Kaiyum2012\SocialiteAuth\Contracts;

interface Sociable
{
    /**
     * @param  $account
     * @return mixed
     */
    public function attachAccount($account);

    public function createUserUsing(array $attributes): Sociable;
}
