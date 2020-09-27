<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 *
 * @package App\Models
 *
 * @property int $id User unique identifier
 * @property string $name User name
 * @property string $email User email
 * @property string $password User password
 * @property bool $is_admin Attribute indicating whether this user is an administrator.
 * @property Carbon $createdAt Date of creating this user.
 * @property Carbon $updatedAt Date of updating info about this user.
 *
 * @method static create(array $array)
 * @method static get()
 * @method static find($id)
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
        'name', 'email', 'password', 'is_admin',
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
        'is_admin' => 'boolean',
    ];

    public function isAdmin()
    {
        return $this->is_admin;
    }
}
