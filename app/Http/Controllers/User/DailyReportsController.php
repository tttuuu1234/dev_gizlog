<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DailyReport;
use Illuminate\Support\Facades\Auth;

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

    public function index()
    {
        //
        $dailyReports = $this->dailyReport->all();
        return view('user.daily_report.index', compact('dailyReports'));
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
    public function store(Request $request)
    {
        //
        $input = $request->all();
        $input['user_id'] = Auth::id();
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
        // dd($reportShow);
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
    public function update(Request $request, $id)
    {
        //
        $input = $request->all();
        $reportUpdate = $this->dailyReport->find($id)->fill($input)->save();
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
