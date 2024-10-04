<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsPlace extends Model
{
    use HasFactory;
    protected $fillable=[
        "name",
        "type",
        "data",
        "evaluation",
        "contact",
        "fav",
        "link",
        "timeVisit",
        "images",
    ];
}
