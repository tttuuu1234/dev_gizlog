<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\TagCategory;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $question;
    public $category;
    public $comment;

    public function __construct(Question $question, TagCategory $category, Comment $comment)
    {
        $this->question = $question;
        $this->category = $category;
        $this->comment = $comment;
        $this->middleware('auth');
    }
     
    public function index(Request $request)
    {
        $inputs = $request->all();
        $questions = $this->question->all();
        $categories = $this->category->all();

        return view('user.question.index', compact('questions', 'categories', 'inputs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->category->all();
        return view('user.question.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        $this->question->fill($inputs)->save();
        return redirect()->route('question.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = $this->question->find($id);
        $comment = $this->comment->find($id);
        return view('user.question.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = $this->question->find($id);
        return view('user.question.edit', compact('question'));
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
    }

    public function mypage()
    {   
        $userId = Auth::id();
        $questions = $this->question->fetchAllPersonalRecords($userId);
        return view('user.question.mypage', compact('questions'));
    }

    public function createComment(Request $request)
    {
        $inputs = $request->all();
        $comment = $this->comment->fill($inputs)->save();
        return redirect()->route('question.index');
    }
}
