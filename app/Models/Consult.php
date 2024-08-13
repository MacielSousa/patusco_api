<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consult extends Model
{
    use HasFactory;

    protected $fillable = ['animal_name', 'animal_type', 'age', 'symptoms', 'date', 'time_of_day', 'user_id', 'doctor_id', 'receptionist_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
