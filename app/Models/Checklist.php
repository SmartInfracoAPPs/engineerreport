<?php
// app/Models/Checklist.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    use HasFactory;

    protected $table = 'checklist';
    protected $primaryKey = 'checklist_id';

    protected $fillable = [
        'task_id',
        'checklist_item',
        'status'
    ];

    public function task()
    {
        return $this->belongsTo(Tasklist::class, 'task_id');
    }
}
