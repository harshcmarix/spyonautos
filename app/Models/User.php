<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'post_code',
        'country',
    ];

    /**
     * The attributes that should be hidden for arrays
     * @var string[]
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types
     * @var string[]
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
