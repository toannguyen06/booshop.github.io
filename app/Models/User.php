<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'email',
        'password',
        'role',
        'point'
    ];
    protected $table = 'users';
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function information(){
        return $this->hasOne(UsersInformation::class, 'user_id');
    }

    public function order(){
        return $this->hasMany(Order::class, 'user_id');
    }

    public function comment(){
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function setPasswordAttribute($password){
        $this->attributes['password'] = Hash::make($password);
    }

    public function getRoleAttribute() {
        if ($this->attributes['role'] == 1){
            return 'RootAdmin';
        }
        if ($this->attributes['role'] == 2){
            return 'Admin';
        }
        if ($this->attributes['role'] == 3){
            return 'User';
        }
    }

    static function userBy($type){
        if ($type == 'day'){
            return static::select(DB::raw('count(*) as y, DAY(created_at) AS x'))
                        ->whereRaw('MONTH(created_at) = MONTH(NOW())')
                        ->groupByRaw('DAY(created_at)')
                        ->get();
        }
        if ($type == 'month'){
            return static::select(DB::raw('count(*) as y, MONTH(created_at) AS x'))
                        ->whereRaw('YEAR(created_at) = YEAR(NOW())')
                        ->groupByRaw('MONTH(created_at)')
                        ->get();
        }
        if ($type == 'new'){
            return static::select(DB::raw('count(*) as userQuantity'))
                        ->whereRaw('DAY(created_at) = DAY(NOW())')
                        ->groupByRaw('DAY(created_at)')
                        ->get();
        }
        
    }
}
