<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
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

    /**
     * @return Builder
     */
    public function feed()
    {
        return Micropost::whereExists(function (\Illuminate\Database\Query\Builder $q) {
            $q->select()
                ->from('relationships')
                ->whereRaw('microposts.user_id = relationships.followed_id')
                ->where('follower_id', '=', $this->id);
        })->orderBy('microposts.created_at', 'DESC');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'relationships', 'followed_id', 'follower_id')->withTimestamps();
    }

    public function followed_users()
    {
        return $this->belongsToMany(User::class, 'relationships', 'follower_id', 'followed_id')->withTimestamps();
    }

    public function follow(User $other)
    {
        $this->followed_users()->attach($other->id);
    }

    public function unfollow(User $other)
    {
        $this->followed_users()->detach($other->id);
    }

    public function isFollowing(User $other)
    {
        return $this->followed_users()->where('followed_id', $other->id)->count() > 0;
    }

    public static function boot()
    {
        parent::boot();
        static::deleted(function (User $user) {
            $user->microposts()->delete();
        });
    }
}
