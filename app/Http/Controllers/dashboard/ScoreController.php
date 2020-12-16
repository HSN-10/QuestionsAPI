<?php

namespace App\Http\Controllers\dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use App\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $scores = $category->scores()->get();
        $category = $category;
        return view('dashboard.score.view', compact(['scores', 'category']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Category  $category
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category $category)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @param  \App\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function show(Score $score, Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Score  $score
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, Score $score)
    {
        return view('dashboard.score.edit', compact(['category', 'score']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Category  category
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category, Score $score)
    {
        $validate = $request->validate([
            'name' => 'required',
            'score' => 'required'
        ]);

        if ($score->update($validate))
            return redirect()->route('score.index', $category->id)->with(['success' => Lang::get('lang.updateSuccess')]);
        else
            return redirect()->route('score.index', $category->id)->with(['error' => Lang::get('lang.updateError')]);
    }

    /**
     * Move to Trash.
     *
     * @param  \App\Category  category
     * @param  \App\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, Score $score)
    {
        if ($score->delete())
            return redirect()->back()->with(['success' => Lang::get('lang.deleteSuccess')]);
        else
            return redirect()->back()->with(['error' => Lang::get('lang.deleteError')]);
    }

    /**
     * Show categories deleted.
     *
     * @param  \App\Category  category
     * @return \Illuminate\Http\Response
     */
    public function trash(Category $category)
    {
        $scores = $category->scores()->onlyTrashed()->get();
        return view('dashboard.score.trash', compact(['category', 'scores']));
    }

    /**
     * Return to storage.
     *
     * @param  \App\Category  category
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function undo(Category $category, $id)
    {
        $score = Score::onlyTrashed()->where('id', $id)->first();
        $score->deleted_at = null;
        if ($score->save())
            return redirect()->back()->with(['success' => Lang::get('lang.undoSuccess')]);
        else
            return redirect()->back()->with(['error' => Lang::get('lang.undoError')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  category
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(Category $category, $id)
    {
        $score = Score::onlyTrashed()->where('id', $id)->first();
        if ($score->forceDelete())
            return redirect()->back()->with(['success' => Lang::get('lang.deleteSuccess')]);
        else
            return redirect()->back()->with(['error' => Lang::get('lang.deleteError')]);
    }
}
