<?php

// app/Models/Image.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';
    protected $primaryKey = 'image_id';

    protected $fillable = [
        'task_id',
        'image_url'
    ];

    public function task()
    {
        return $this->belongsTo(Tasklist::class, 'task_id');
    }
}