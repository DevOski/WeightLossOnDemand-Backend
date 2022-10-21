<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Visit extends Model
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
        'visit_token',
        'habbits',
        'drugs_alergies',
        'medications',
        'medical_conditions',
        'surgeries'
    ];

}
