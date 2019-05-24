<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\QuestionsRequest;
use App\Http\Requests\User\CommentRequest;
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

        
        if(array_key_exists('search_word', $inputs)) {
            $questions = $this->question->fetchSearchWordRecords($inputs);
        } else {
            $questions = $this->question->orderby('created_at', 'desc')->get();
        }

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
    public function store(QuestionsRequest $request)
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
        $questions = $this->question->find($id);
        $categories = $this->category->all();
        return view('user.question.edit', compact('questions', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionsRequest $request, $id)
    {
        $inputs = $request->all();
        $this->question->find($id)->fill($inputs)->save();
        return redirect()->route('question.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->question->find($id)->delete();
        return redirect()->route('question.index');
    }

    public function mypage()
    {   
        $userId = Auth::id();
        $questions = $this->question->fetchAllPersonalRecords($userId);
        return view('user.question.mypage', compact('questions'));
    }

    public function createComment(CommentRequest $request)
    {
        $inputs = $request->all();
        $this->comment->fill($inputs)->save();
        return redirect()->route('question.index');
    }

    public function confirm(QuestionsRequest $request, $id = null)
    {
        $inputs = $request->all();
        if($id == null){
            $question = $this->question->fill($inputs);
        } else {
            $question = $this->question->find($id)->fill($inputs);
        }
        return view('user.question.confirm', compact('question', 'inputs'));
    }
}
