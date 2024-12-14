<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScreenEvent extends Model
{
    use HasFactory;

    protected $table = 'screen_events';

    protected $fillable = ['id','idTracking','objectName', 'url'];
}
