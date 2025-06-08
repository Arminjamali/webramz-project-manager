<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\JalaliDate;

class Figma extends Model
{
    use HasFactory;

    protected $casts = [
        'date' => JalaliDate::class,
    ];

    protected $fillable = [
        'name',
        'date',
        'project_id',
    ];

    // روابط با سایر مدل‌ها
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
