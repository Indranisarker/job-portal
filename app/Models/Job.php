<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

  protected $fillable = [
    'title',
    'category_id',
    'job_type_id',
    'vacancy',
    'salary',
    'location',
    'experience',
    'description',
    'benefits',
    'responsibility',
    'qualification',
    'company_name',
    'main_branch',
    'website',
];

}
