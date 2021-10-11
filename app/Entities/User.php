<?php

namespace App\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Laravel\Passport\HasApiTokens;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class User.
 *
 * @package namespace App\Entities;
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract, Transformable
{
    use HasApiTokens, Authenticatable, Authorizable, TransformableTrait;

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'password',
        'email',
        'phone',
    ];

    protected $hiddens = [
        'password',
    ];

    public function address()
    {
        return $this->hasMany(Address::class);
    }
}
