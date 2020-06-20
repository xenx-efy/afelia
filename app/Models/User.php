<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @package App\Models
 * @property integer $id User unique identifier
 * @property string $name User name
 * @property string $email User email
 * @property string $password User password
 * @property boolean $isAdmin Attribute indicating whether this user is an administrator.
 * @property Carbon $createdAt Date of creating this user.
 * @property Carbon $updatedAt Date of updating info about this user.
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean'
    ];

    /**
     * Map the table columns names with models magic properties,
     * $model->createdAt for example
     *
     * @var string[]
     */
    protected $maps = [
        'created_at' => 'createdAt',
        'updated_at' => 'updatedAt',
        'is_admin' => 'isAdmin'
    ];
}
