<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\SearchingScope;

class DailyReport extends Model
{
    //
    use SoftDeletes, SearchingScope; 

    protected $fillable = [
        'title',
        'contents',
        'reporting_time',
        'user_id'
    ];
    
    protected $dates = ['reporting_time', 'deleted_at']; //format関数を使用するときに$datesの配列に使用したいカラムの値を指定

    public function fetchSearchingQuestion($conditions)
    {
        return $this->filterLike('reporting_time', $conditions['search_word']) //filterlikeで$conditionsの中のkeyのseacrh_wordの値とreporting_timeカラムの値で一致している値を
                    ->orderby('created_at', 'desc');//created_atカラムを降順で並べる
    }
}
