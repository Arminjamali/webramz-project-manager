<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\JalaliDate;

class Report extends Model
{
    use HasFactory;
    protected $casts = [
        'date' => JalaliDate::class,
    ];

    protected $fillable = [
        'title',
        'description',
        'date',
        'project_id',
        'user_id',
    ];

    // روابط با سایر مدل‌ها
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
