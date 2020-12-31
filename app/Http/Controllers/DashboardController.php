<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index(User $user)
    {
        $questions = Question::with('user')
                                ->where('user_id', '=', $user->id)
                                ->latest()
                                ->get();

        $replies = Reply::with('user')
                                ->where('user_id', '=', $user->id)
                                ->latest()
                                ->get();

        $q_count = 'Asked ' . $questions->count() . ' ' . Str::plural('question', $questions->count());
        $r_count = 'Given '. $replies->count() . ' ' . Str::plural('answer', $questions->count());

        foreach ($questions as $question) {
            $question->body_excerpt = Str::words($question->body, 20);
            $question->category = $question->category;

            $question->reply_count = $question->replies->count() .
                                        ' ' .
                                        Str::plural('reply', $question->replies->count());

            $question->time_diff = $question->created_at->diffForHumans();
        }

        foreach ($replies as $reply) {
            $reply->time_diff = $reply->created_at->diffForHumans();
        }

        return Inertia::render('Dashboard/Dashboard', [
            'user' => $user,
            'questions' => $questions,
            'replies' => $replies,
            'q_count' => $q_count,
            'r_count' => $r_count
        ]);
    }
}
