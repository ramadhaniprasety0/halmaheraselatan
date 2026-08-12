<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorReview extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'rating', 'comment', 'is_approved'];
}
