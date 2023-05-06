<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnforcementProceedingsDateVisitBailiffMany extends Model{
    use HasFactory, SoftDeletes;
    
    public $timestamps = true;
    
    protected $dates = ['deleted_at'], $fillable = ['*'], $table = 'enforcement_proceedings_date_visit_bailiff__many';
}