<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Models\Question;
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

        foreach ($questions as $question) {
            $question->body_excerpt = Str::words($question->body, 20);
            $question->user = $question->user;
            $question->reply_count = $question->replies->count() . ' ' . Str::plural('reply', $question->replies->count());
            $question->time_diff = $question->created_at->diffForHumans();
        }

        return Inertia::render('Forum/Index', [
            'questions' => $questions
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Question $question)
    {
        //
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
        //
    }
}
