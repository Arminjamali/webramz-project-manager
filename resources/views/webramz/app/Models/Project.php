<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Casts\JalaliDate;

class Project extends Model
{
    use HasFactory;

    protected $casts = [
        'delivery_date' => JalaliDate::class,
        'start_date' => JalaliDate::class,
        'sign_date' => JalaliDate::class
    ];

    protected $fillable = [
        'name',
        'type',
        'plan',
        'lang',
        'figma_count',
        'days',
        'delivery_date',
        'start_date',
        'sign_date',
        'ticket',
        'demo',
        'figma',
        'domain',
        'status',
        'design_status',
        'designer_id',
        'developer_id',
        'customer_id',
    ];


    // روابط

    public function designer()
    {
        return $this->belongsTo(User::class, 'designer_id');
    }

    public function developer()
    {
        return $this->belongsTo(User::class, 'developer_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }


    public function logs()
    {
        return $this->hasMany(Log::class);  // یک پروژه می‌تواند چندین لاگ داشته باشد
    }

    public function figmas()
    {
        return $this->hasMany(Figma::class);  // یک پروژه می‌تواند چندین فایل Figma داشته باشد
    }

    public function reports()
    {
        return $this->hasMany(Report::class);  // یک پروژه می‌تواند چندین گزارش داشته باشد
    }


}
