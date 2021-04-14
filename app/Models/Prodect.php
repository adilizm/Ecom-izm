<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prodect extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable =['name','description','price','image1','image2','image3','slug','qty','categori_id','show_in_home'];
}
