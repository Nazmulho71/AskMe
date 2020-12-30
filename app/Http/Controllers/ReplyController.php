<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Question $question)
    {
        return Inertia::render('Forum/Answer', [
            'question' => $question
        ]);
    }

    public function store(Request $request, Question $question)
    {
        $this->validate($request, [
            'body' => 'required|max:2500'
        ]);

        Reply::create([
            'body' => $request->body,
            'question_id' => $question->id,
            'user_id' => auth()->id()
        ]);
    }
}
