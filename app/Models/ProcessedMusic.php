<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessedMusic extends Model
{
    use HasFactory;

    protected $fillable = ['original_filename', 'processed_filename', 'path'];
}
