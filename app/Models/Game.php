<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'date',
        'home_team',
        'away_team',
        'home_total_score',
        'away_total_score',
        'home_total_hits',
        'away_total_hits',
        'home_total_errors',
        'away_total_errors',
        'home_inning_1', 'home_inning_2', 'home_inning_3', 'home_inning_4', 'home_inning_5', 
        'home_inning_6', 'home_inning_7', 'home_inning_8', 'home_inning_9',
        'away_inning_1', 'away_inning_2', 'away_inning_3', 'away_inning_4', 'away_inning_5', 
        'away_inning_6', 'away_inning_7', 'away_inning_8', 'away_inning_9',
    ];
}