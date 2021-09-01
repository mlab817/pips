<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Collaborator extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::saving(function ($collaborator) {
            $collaborator->token = Str::random(60);
        });
    }

    protected $fillable = [
        'project_id',
        'collaborator_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'collaborator_id');
    }
}
