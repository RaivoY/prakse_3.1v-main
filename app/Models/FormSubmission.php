<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    protected $fillable = ['email', 'comments', 'topic', 'priority'];

    protected $table = 'form_submissions';
}
