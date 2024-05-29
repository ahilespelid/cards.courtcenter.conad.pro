<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model{
    use HasFactory;//, SoftDeletes;
    
    public $timestamps = true, $table = 'history';
    protected $dates = ['deleted_at'], $dateFormat = 'Y-m-d H:i:s', $fillable = ['deal','instance','name','key','value'], $guarded = [];
    protected $connection = 'one';
}
