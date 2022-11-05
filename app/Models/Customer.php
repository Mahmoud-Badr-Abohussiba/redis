<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Mailable;

class Customer extends Model
{
    use HasFactory;

    protected $fillable=['name', 'national_id','mail','sub_end_date'];
}
