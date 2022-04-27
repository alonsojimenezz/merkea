<?php

namespace App\Models;

use Attribute;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
        'last_login_time',
        'last_login_ip',
        'agent',
        'session_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function initials(): string
    {
        $words = explode(' ', $this->name);
        $initials = '';

        $realWords = [];

        foreach ($words as $word) {
            if (strlen($word) > 3) {
                $realWords[] = $word;
            }
        }

        foreach ($realWords as $word) {
            $initials .= mb_substr($word, 0, 1);
        }

        $initials = strlen($initials) <= 2 ? $initials : (strlen($initials) < 4 ? mb_substr($initials, 0, 2) : $initials[0] . $initials[2]);

        return strtoupper($initials);
    }
}
