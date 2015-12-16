<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function getAdminAttribute($value)
    {
        return (bool) $value;
    }

    public function microposts()
    {
        return $this->hasMany(Micropost::class)->orderBy('created_at', 'DESC');
    }

    public function feed()
    {
        return Micropost::where('user_id', $this->id)->orderBy('created_at', 'DESC');
    }

    public static function boot()
    {
        parent::boot();
        static::deleted(function (User $user) {
            $user->microposts()->delete();
        });
    }
}
