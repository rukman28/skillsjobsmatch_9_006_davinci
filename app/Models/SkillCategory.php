<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SkillCategory extends Model
{
    use SoftDeletes;

    protected $dates=['deleted_at'];

    protected $fillable=[
        'title',
        'added_by',
    ];

    public function editor(){
        return $this->belongsTo('User','id','added_by');
    }

    public function skills(){
        return $this->hasMany(Skill::class);
    }
}
