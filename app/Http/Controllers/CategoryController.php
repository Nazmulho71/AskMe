<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function getCategory()
    {
        $categories = Category::orderBy('name')->get();

        return response()->json($categories);
    }

    public function index(Category $category)
    {
        $questions = Question::with('category')
            ->where('category_id', '=', $category->id)
            ->latest()
            ->get();

        foreach ($questions as $question) {
            $question->body_excerpt = Str::words($question->body, 20);
            $question->user = $question->user;
            $question->reply_count = $question->replies->count() . ' ' . Str::plural('reply', $question->replies->count());
            $question->category = $question->category;
            $question->time_diff = $question->created_at->diffForHumans();
        }

        return Inertia::render('Category/Index', [
            'category' => $category,
            'questions' => $questions
        ]);
    }

    public function createQue(Category $category)
    {
        return Inertia::render('Category/Ask', [
            'category' => $category
        ]);
    }
}
