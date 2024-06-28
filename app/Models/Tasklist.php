<?php

// app/Models/Tasklist.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasklist extends Model
{
    use HasFactory;

    protected $table = 'tasklist';
    protected $primaryKey = 'task_id';

    protected $fillable = [
        'task_status',
        'field_engineer_id',
        'site_id',
        'task_description'
    ];

    public function fieldEngineer()
    {
        return $this->belongsTo(User::class, 'field_engineer_id');
    }

    public function checklists()
    {
        return $this->hasMany(Checklist::class, 'task_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'task_id');
    }
}
