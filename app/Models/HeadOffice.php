<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HeadOffice extends Model
{
    //
    protected $table = "audit_headoffice";
    use HasFactory;

    protected $fillable = ['doc_number','division_id','division_name','head_id','file_path','tipe','sop_id','user_id'];
}
