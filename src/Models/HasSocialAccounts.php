<?php

namespace Kaiyum2012\SocialiteAuth\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Kaiyum2012\SocialiteAuth\Contracts\Sociable;

trait HasSocialAccounts
{
    public static $authenticatedRoute = '/dashboard';

    public function socialAccounts(): HasMany
    {
        return $this->hasMany(SocialAccount::class, 'id', 'user_id');
    }

    public function createUserUsing(array $attributes = []): Sociable
    {
        return $this->fill($attributes);
    }

    public function attachAccount($account)
    {
        return $this->socialAccounts()->save($account);
    }

}
