<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Programme;
use App\Models\User;
use App\Models\Practical;
use App\Models\Level;

class Module extends Model
{
    use SoftDeletes;

    protected $dates=['deleted_at'];

    protected $fillable = [
        'title', 'code', 'added_by'
    ];

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function programmes(){
        return $this->belongsToMany(Programme::class,'level_module_programme')->withTimestamps()->withPivot('added_by','level_id');
    }

    public function levels(){
        return $this->belongsToMany(Level::class,'level_module_programme')->withTimestamps()->withPivot('added_by','programme_id');
    }

    public function practicals(){
        //return $this->belongsToMany('Practical')->withTimestamps()->withPivot('added_by');
        return $this->belongsToMany(Practical::class)->withTimestamps()->withPivot('added_by')->orderBy('title');
    }

}
