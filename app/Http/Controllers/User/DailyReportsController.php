<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\DailyReportRequest;
use App\Models\DailyReport;
use Illuminate\Support\Facades\Auth;

const DAILY_MAX_PAGE_COUNT= 30; //最大30記事を1ページに表示 already defineと出てroute listが見れない

class DailyReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $dailyReport;

    public function __construct(DailyReport $dailyReport)
    {
        $this->dailyReport = $dailyReport;
        $this->middleware('auth');
    } 

    public function index(Request $request)
    {
        //
        $inputs = $request->all(); //検索条件の取得

        if (array_key_exists('search_word', $inputs)) { //search_wordキーが$inputsの配列内に含まれているか search_wordはどの段階でkeyとしてセットされているのか
            $dailyReports = $this->dailyReport->fetchSearchingQuestion($inputs)->paginate(DAILY_MAX_PAGE_COUNT); 
        } else {
            $dailyReports = $this->dailyReport->orderby('created_at', 'desc')->paginate(DAILY_MAX_PAGE_COUNT); //なかったらcreated_atカラムの値を降順で表示 新しく作られた順
        }

        return view('user.daily_report.index', compact('dailyReports', 'inputs')); //検索結果と検索条件をhtmlに返す
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('user.daily_report.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DailyReportRequest $request)  //Formから送られてきた値をDailyReportRequestでvalidateかけている
    {
        //
        $input = $request->all();
        $input['user_id'] = Auth::id(); //現在認証されているユーザーのIDを取得しuser_idに入れている これで認証済みユーザーへアクセスしている これをしないとユーザーidに何もないよとエラー出る
        $this->dailyReport->fill($input)->save();
        return redirect()->route('daily.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $reportShow = $this->dailyReport->find($id);
        $reportShow['user_id'] = Auth::id();        
        return view('user.daily_report.show', compact('reportShow'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $reportEdit = $this->dailyReport->find($id);
        return view('user.daily_report.edit', compact('reportEdit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DailyReportRequest $request, $id)
    {
        //
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $this->dailyReport->find($id)->fill($input)->save();
        return redirect()->route('daily.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $dailyDelete = DailyReport::find($id); //ファサードの記法で書く DailyReportから$find()で取得したidのオブジェクトを取得
        $dailyDelete->delete();
        return redirect()->route('daily.index');
    }
}
