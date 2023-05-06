<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourtsAppealInformationProgressMany extends Model{
    use HasFactory, SoftDeletes;
    
    public $timestamps = true;
    
    protected $dates = ['deleted_at'], $fillable = ['*'], $table = 'courts_appeal_information_progress__many';
}