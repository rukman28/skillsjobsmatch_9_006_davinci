<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Skill;

class Practical extends Model
{
    use SoftDeletes;

    protected $dates=['deleted_at'];

    protected $fillable = [
        'title', 'added_by'
    ];

    public function skills(){
        //return $this->belongsToMany('Skill')->withTimestamps()->withPivot('added_by');
        return $this->belongsToMany(Skill::class)->withTimestamps()->withPivot('added_by');
    }


    public function modules(){
        return $this->belongsToMany(Module::class)->withTimestamps()->withPivot('added_by');
    }

    public function admin(){
        return $this->belongsTo(Admin::class);
    }
}
