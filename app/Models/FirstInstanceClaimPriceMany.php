<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirstInstanceClaimPriceMany extends Model{
    use HasFactory, SoftDeletes;
    
    public $timestamps = true, $table = 'first_instance_claim_price__many';
    
    protected $dates = ['deleted_at'], $dateFormat = 'Y-m-d H:i:s', $fillable = ['*'], $guarded = [];
protected $connection = 'two';}