<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'login',
        'password',
        'settings'
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
        'password' => 'hashed',
        'settings' => 'array'
    ];

    public static array $castRoles = [
        'admin' => 'Администратор',
        'manager' => 'Менеджер',
        'user' => 'Пользователь'
    ];

    public function role() : string
    {
        return @self::$castRoles[$this->roles()->first()->name] ?? 'Гость';
    }

    public function roleWithoutCast() : string
    {
        return $this->roles()->first()->name ?? 'none';
    }

    public function isAdmin(): bool
    {
        return $this->roleWithoutCast() == 'admin';
    }

    public function alias(): string
    {
        return '#' . $this->id . '-' . $this->login . '@' . $this->role();
    }

    public function setLocale(string $locale)
    {
        $settings = $this->settings;
        $settings['locale'] = $locale;
        $this->settings = $settings;
        $this->save();
    }

    public function getLocale()
    {
        return $this->settings['locale'] ?? null;
    }

}
