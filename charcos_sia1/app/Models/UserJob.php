<?php
 namespace App\Models;

 use Illuminate\Database\Eloquent\Model;

 class UserJob extends Model{
    protected $table = 'tbluserjob';
 // column sa table
    protected $fillable = [
    'jobId', 'jobName'
     ];

    public $timestamps = false;
    protected $primaryKey = 'jobId';
 }