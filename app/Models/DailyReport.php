<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyReport extends Model
{
    //
    use SoftDeletes;

    protected $delete = ['deleted_at']; //削除したら自動でこのカラムに値を入れる
    protected $fillable = ['title', 'contents', 'reporting_time', 'user_id'];
}
