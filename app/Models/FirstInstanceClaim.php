<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirstInstanceClaim extends Model{
    use HasFactory, SoftDeletes;
    
    public $timestamps = true, $table = 'first_instance_claim';
    
    protected $dates = ['deleted_at'], $dateFormat = 'Y-m-d H:i:s', $fillable = ['*'], $guarded = [];
    
    public function many(){
        return $this->hasMany(FirstInstanceClaimMany::class);
    }

}