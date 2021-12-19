<?php

namespace Kaiyum2012\SocialiteAuth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SocialAccount extends Model
{
    use HasFactory;

    protected $table = 'social_accounts';

    protected $fillable = [
        'user_id',
        'identifier',
        'provider',
        'token',
        'expire_on',
        'data'
    ];

    protected $casts = [
        'data' => 'array'
    ];

    /* Relationships */

    public function user(): HasOne
    {
        return $this->hasOne(config('socialite-auth.user_model'), 'id', 'user_id');
    }
}
