<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfessorImages extends Model
{
    protected $fillable = [
        'professor_id' => 'required',
        'imageURL' => 'required|mimes:jpeg,png,jpg'
    ];
}
