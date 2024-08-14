<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class authorization extends Model
{
    use HasFactory;

    protected $table = "authorization";

    protected $fillable = ["authorization", "is_used", "created_at", "updated_at"];
}
