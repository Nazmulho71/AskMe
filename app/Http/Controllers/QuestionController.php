<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use App\Models\Reply;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $questions = Question::latest()->get();
        
        $questions->q_counts = $questions->count();

        foreach ($questions as $question) {
            $question->body_excerpt = Str::words($question->body, 20);
            $question->user = $question->user;
            $question->reply_count = $question->replies->count() . ' ' . Str::plural('reply', $question->replies->count());
            $question->category = $question->category;
            $question->time_diff = $question->created_at->diffForHumans();
        }

        return Inertia::render('Forum/Index', [
            'questions' => $questions
        ]);
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return Inertia::render('Forum/Ask', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'category' => 'required|integer',
            'body' => 'required|max:2500'
        ]);

        Question::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'category_id' => $request->category,
            'body' => $request->body,
            'user_id' => auth()->id()
        ]);
    }

    public function show(Question $question)
    {
        $question->body_excerpt = Str::words($question->body, 20);
        $question->user = $question->user;
        $question->category = $question->category;
        $question->reply_count = $question->replies->count() . ' ' . Str::plural('reply', $question->replies->count());
        $question->replies_count = $question->replies->count();
        $question->isAuthAsked = ($question->user->id == auth()->id()) ? true : false;
        $question->time_diff = $question->created_at->diffForHumans();

        $replies = Reply::with('question')->where('question_id', '=', $question->id)->latest()->get();

        foreach ($replies as $reply) {
            $reply->user = $reply->user;
            $reply->likes_count = $reply->likes->count();
            $reply->isAuthReplied = $reply->user->id == auth()->id();
            $reply->likes = $reply->likes;

            foreach ($reply->likes as $like) {
                $reply->isLiked = ($like->user->id === auth()->id()) ? true : false;
            }

            $reply->time_diff = $reply->created_at->diffForHumans();
        }

        return Inertia::render('Forum/Question', [
            'question' => $question,
            'replies' => $replies
        ]);
    }

    public function edit()
    {
        //
    }

    public function update(Request $request, Question $question)
    {
        //
    }

    public function destroy(Question $question)
    {
        $question->delete();
        
        $replies = $question->replies;

        foreach ($replies as $reply) {
            $reply->likes->delete();
        }
    }
}
