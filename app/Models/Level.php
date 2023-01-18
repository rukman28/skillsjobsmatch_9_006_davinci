<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Module;

class Level extends Model
{
    use SoftDeletes;

    protected $dates=['deleted_at'];

    protected $fillable = [
        'title','added_by'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function programmes(){
        return $this->belongsToMany(Programme::class,'level_module_programme')->withTimestamps()->withPivot('added_by','module_id');
    }

    public function modules(){
        return $this->belongsToMany(Module::class,'level_module_programme')->withTimestamps()->withPivot('added_by','programme_id');

    }
}
