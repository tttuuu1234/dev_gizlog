<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\SearchingScope;


class DailyReport extends Model
{
    //
    use SoftDeletes, SearchingScope;

    protected $delete = ['deleted_at']; //削除したら自動でこのカラムに値を入れる
    protected $fillable = ['title', 'contents', 'reporting_time', 'user_id'];
    protected $dates = ['reporting_time']; //format関数を使用するときに$datesの配列に使用したいカラムの値を指定

    public function fetchPersonalRecords($user_id)
    {
        return $this->where('user_id', $user_id)
                    ->orderBy('reporting_time', 'desc')
                    ->get();
    }

    public function fetchSearchingQuestion($conditions)
    {
        return $this->filterLike('reporting_time', $conditions['search_word'])
                    // ->filterEqual('user_id', $conditions['user_id'])
                    ->orderby('created_at', 'desc');
    }

}
