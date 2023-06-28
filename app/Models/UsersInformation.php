<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersInformation extends Model
{
    use HasFactory;

    protected $fillable = ['fullname', 'gender', 'date_of_birth', 'avatar', 'address', 'phone', 'user_id'];

    public function user (){
        return $this->belongsTo(User::class);
    }

    // public function getGenderAttribute() {
    //     if ($this->attributes['gender'] == 1){
    //         return "Nam";
    //     }
    //     if ($this->attributes['gender'] == 2){
    //         return "Nữ";
    //     }
    // }
    
    public function getDOBAttribute() {
        return date('d/m/Y',strtotime($this->attributes['date_of_birth']));
    }
}
