<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Practical;

class Skill extends Model
{

    use SoftDeletes;

    protected $dates=['deleted_at'];

    protected $fillable=[
        'title',
        'skill_category_id',
        'added_by'
    ];

    public function admin(){
        return $this->belongsTo(User::class);
    }

    public function skillCategory(){
        return $this->belongsTo(SkillCategory::class);
    }


    public function practicals(){
        return $this->belongsToMany(Practical::class)->withTimestamps()->withPivot('added_by');
    }

}
