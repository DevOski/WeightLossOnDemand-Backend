<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Appointment extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_token',
        'reason',
        'response_1',
        'response_2',
        'response_3',
        'response_4',
        'response_5',
        'trainer_id',
        'tr_name',
        'apt_token',
        'habbits',
        'drugs_alergies',
        'medications',
        'medical_conditions',
        'surgeries',
        'apt_token',
        'apt_time',
        'apt_day',
        'apt_date'
        
    ];

}
