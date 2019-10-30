<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Str;

/**
  * @property int $id
  * @property string $name
  * @property string $email
  * @property string $status
 * @property string $password
 * @property string verify_token
 *
 */

class User extends Authenticatable
{
    use Notifiable;

    public const STATUS_WAIT = 'wait';
    public const STATUS_ACTIVE = 'active';


    protected $fillable = [
        'name', 'email', 'password','status','verify_token'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function register(string  $name, string $email, string  $password): self
    {
        return static ::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
            'verify_token' => Str::uuid(),
            'status' => self::STATUS_WAIT
        ]);
    }


    public static function new($name,$email): self
    {
        return static::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt(Str::random()),
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    public function isWait(): bool
    {
        return $this->status === self::STATUS_WAIT;
    }


    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function verify(): void
    {
        if(!$this->isWait()){
            throw new \DomainException('User is already verified.');
        }

      $this->setStatusActive();
    }

    public function statusToggle()
    {
        return (!$this->isActive()) ? $this->setStatusActive():$this->setStatusWait();

    }


    protected function setStatusActive()
    {
        $this->update([
            'status' => self::STATUS_ACTIVE,
            'verify_token' => null,
        ]);
    }


    protected function setStatusWait()
    {
        return $this->update([
            'status' => self::STATUS_WAIT,
            'verify_token' => Str::uuid()
        ]);
    }


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
