<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class StudentModel extends Model
{
    use HasFactory; 
    use Notifiable;
    use SoftDeletes;

    protected $table        = 'student';
    protected $primaryKey   = 'id';
    protected $fillable     = ['name', 'email', 'location', 'pincode'];
}
