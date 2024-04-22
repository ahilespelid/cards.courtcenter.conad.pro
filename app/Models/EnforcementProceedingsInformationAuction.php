<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnforcementProceedingsInformationAuction extends Model{
    use HasFactory, SoftDeletes;
    
    public $timestamps = true, $table = 'enforcement_proceedings_information_auction';
    
    protected $dates = ['deleted_at'], $fillable = ['*'], $dateFormat = 'Y-m-d H:i:s', $guarded = [];
protected $connection = 'two';}