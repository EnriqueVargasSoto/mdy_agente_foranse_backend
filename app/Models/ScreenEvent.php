<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScreenEvent extends Model
{
    use HasFactory;

    protected $table = 'af_recursos';

    protected $fillable = ['id','in_TrackingId','objectName', 'url'];

    public function tracking()
    {
        return $this->belongsTo(Tracking::class, 'in_TrackingId', 'id');
    }
}
