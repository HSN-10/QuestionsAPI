<?php

namespace App\Http\Controllers\dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.category.view', compact(['categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('main_category_id', 0)->get();
        return view('dashboard.category.create', compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path = 'images/category';
        $validate = $request->validate([
            'name' => 'required',
            'image' => 'required|image',
            'main_category_id' => 'required'
        ]);

        $saveImage = $request->file('image')->store('public/' . $path);
        $save = Category::create([
            'name' => $request->name,
            'image' => $path . '/' . basename($saveImage),
            'main_category_id' => $request->main_category_id
        ]);

        if ($save)
            return redirect()->route('category.index')->with(['success' => Lang::get('lang.addSuccess')]);
        else
            return redirect()->route('category.index')->with(['error' => Lang::get('lang.addError')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::where('main_category_id', 0)->get();
        return view('dashboard.category.edit', compact(['category', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $path = 'images/category';
        $validate = $request->validate([
            'name' => 'required',
            'image' => 'image',
            'main_category_id' => 'required'
        ]);

        if ($request->file('image')) {
            if (!File::exists('public/' . $category->image))
                Storage::delete('public/' . $category->image);
            $saveImage = $request->file('image')->store('public/' . $path);
            $category->image = $path . '/' . basename($saveImage);
        }
        $category->name = $request->name;
        $category->main_category_id = $request->main_category_id;
        if ($category->save())
            return redirect()->route('category.index')->with(['success' => Lang::get('lang.updateSuccess')]);
        else
            return redirect()->route('category.index')->with(['error' => Lang::get('lang.updateError')]);
    }

    /**
     * Move to Trash.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ($category->delete())
            return redirect()->back()->with(['success' => Lang::get('lang.deleteSuccess')]);
        else
            return redirect()->back()->with(['error' => Lang::get('lang.deleteError')]);
    }

    /**
     * Show categories deleted.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $categories = Category::onlyTrashed()->get();
        return view('dashboard.category.trash', compact(['categories']));
    }

    /**
     * Return to storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function undo($id)
    {
        $category = Category::onlyTrashed()->where('id', $id)->first();
        $category->deleted_at = null;
        if ($category->save())
            return redirect()->back()->with(['success' => Lang::get('lang.undoSuccess')]);
        else
            return redirect()->back()->with(['error' => Lang::get('lang.undoError')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->where('id', $id)->first();

        if (!File::exists('public/' . $category->image))
            Storage::delete('public/' . $category->image);

        if ($category->forceDelete())
            return redirect()->back()->with(['success' => Lang::get('lang.deleteSuccess')]);
        else
            return redirect()->back()->with(['error' => Lang::get('lang.deleteError')]);
    }
}
