<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\ScoreResource;
use App\Question;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display the Categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CategoryResource::collection(Category::all());
    }

    /**
     * Display the Questions form each category.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function questions(Category $category)
    {
        return QuestionResource::collection($category->questions()->where('active', 1)->get());
    }
    /**
     * Display the Scores form each category.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function scores(Category $category)
    {
        return ScoreResource::collection($category->scores()->get());
    }
    /**
     * Save Score.
     *
     * @param  \App\Category  $category
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveScore(Category $category, Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'score' => 'required'
        ]);
        $Save = $category->scores()->create($request->all());
        if ($Save) {
            return response()->json(['message' => 'Add successfully'], 200);
        }
        return response()->json(['message' => 'Some error happened, please try again'], 500);
    }
    /**
     * Suggestion Question
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function suggestionQuestion(Request $request)
    {
        $validate = $request->validate([
            'question' => 'required',
            'correct_answer' => 'required',
            'answer2' => 'required',
            'answer3' => 'required',
            'answer4' => 'required',
            'category_id' => 'required'
        ]);
        $Save = Question::create($request->all());
        if ($Save) {
            return response()->json(['message' => 'Add successfully'], 200);
        }
        return response()->json(['message' => 'Some error happened, please try again'], 500);
    }
}
