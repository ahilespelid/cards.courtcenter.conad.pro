<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankruptcyStrategy extends Model{
    use HasFactory, SoftDeletes;
    
    public $timestamps = true;
    
    protected $dates = ['deleted_at'], $fillable = ['*'], $table = 'bankruptcy_strategy';
}