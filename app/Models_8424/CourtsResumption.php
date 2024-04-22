<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourtsResumption extends Model{
    use HasFactory, SoftDeletes;
    
    public $timestamps = true, $table = 'courts_resumption';
    
    protected $dates = ['deleted_at'], $fillable = ['*'], $dateFormat = 'Y-m-d H:i:s', $guarded = [];
}