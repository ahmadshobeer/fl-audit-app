<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class HeadOffice extends Model
{
    //
    use HasFactory;
    use SoftDeletes;
    protected $table = "audit_headoffice";
    protected $dates = ['deleted_at']; 

    protected $fillable = ['doc_number','division_id','division_name','head_id','file_path','tipe','sop_id','user_id'];
}
