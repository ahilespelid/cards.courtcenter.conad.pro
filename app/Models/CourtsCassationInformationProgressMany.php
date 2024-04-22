<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourtsCassationInformationProgressMany extends Model{
    use HasFactory, SoftDeletes;
    
    public $timestamps = true, $table = 'courts_сassation_information_progress__many';
    
    protected $dates = ['deleted_at'], $fillable = ['*'], $dateFormat = 'Y-m-d H:i:s', $guarded = [];
protected $connection = 'two';}