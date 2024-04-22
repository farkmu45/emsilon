<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected static function booted(): void
    {
        static::created(function (User $user) {
            $group = Group::create(['name' => 'Personal']);
            Member::create([
                'group_id' => $group->id,
                'user_id' => $user->id,
                'is_creator' => true
            ]);
        });
    }

    public function personalGroup() {
        return Group::whereIn(
            'id',
            Member::where('user_id', $this->id)
                ->get('group_id')
                ->toArray()
        )->where('name', 'Personal')->first();
    }

    public function groups()
    {
        return Group::whereIn(
            'id',
            Member::where('user_id', $this->id)
                ->get('group_id')
                ->toArray()
        )->where('name', '!=', 'Personal')->get();
    }

    public function groupsWithPersonal() {
        return Group::whereIn(
            'id',
            Member::where('user_id', $this->id)
                ->get('group_id')
                ->toArray()
        )->get();
    }
}
