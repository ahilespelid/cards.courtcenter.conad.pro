<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirstInstanceDateUpcomingCaseMany extends Model{
    use HasFactory, SoftDeletes;
    
    public $timestamps = true;
    
    protected $dates = ['deleted_at'], $fillable = ['*'], $table = 'first_instance_date_upcoming_case__many';
}