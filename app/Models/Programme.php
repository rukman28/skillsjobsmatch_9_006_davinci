<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Programme extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates=['deleted_at'];

    protected $fillable = [
        'title', 'added_by'
    ];

    public function modules(){
        return $this->belongsToMany(Module::class,'level_module_programme')->withTimestamps()->withPivot('added_by','level_id');
    }

    public function admin(){
        return $this->belongsTo(User::class);
    }

    public function levels(){
        return $this->belongsToMany(Level::class,'level_module_programme')->withTimestamps()->withPivot('added_by','module_id');
    }

    public function users(){
        return $this->hasMany(User::class);
    }
}
