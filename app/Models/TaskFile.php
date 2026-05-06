<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskFile extends Model
{
    protected $fillable = [
        'user_id',
        'file_name',
        'file_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
