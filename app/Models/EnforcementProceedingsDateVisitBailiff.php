<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnforcementProceedingsDateVisitBailiff extends Model{
    use HasFactory, SoftDeletes;
    
    public $timestamps = true, $table = 'enforcement_proceedings_date_visit_bailiff';
    
    protected $dates = ['deleted_at'], $fillable = ['*'], $dateFormat = 'Y-m-d H:i:s', $guarded = [];
}