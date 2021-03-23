<?php

namespace App\Http\Controllers\dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();
        return view('dashboard.question.view', compact(['questions']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $categoryDefault = 0;
        return view('dashboard.question.create', compact(['categories', 'categoryDefault']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createWithCategory(Category $category)
    {
        $categories = Category::all();
        $categoryDefault = $category->id;
        return view('dashboard.question.create', compact(['categories', 'categoryDefault']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path = 'images/questions';
        $pathAnswers = 'images/questions/answers';
        $validate = $request->validate([
            'question' => 'required',
            'with_image' => 'required',
            'image' => 'image',
            'correct_answer' => 'required',
            'answer2' => 'required',
            'answer3' => 'required',
            'answer4' => 'required',
            'active' => 'required',
            'category_id' => 'required'
        ]);


        if ($request->with_image == 1) {
            $image = $request->file('image')->store('public/' . $path);
            $correct_answer = $request->file('correct_answer')->store('public/' . $pathAnswers);
            $answer2 = $request->file('answer2')->store('public/' . $pathAnswers);
            $answer3 = $request->file('answer3')->store('public/' . $pathAnswers);
            $answer4 = $request->file('answer4')->store('public/' . $pathAnswers);

            $save = Question::create([
                'question' => $request->question,
                'with_image' => $request->with_image,
                'image' => $path . '/' . basename($image),
                'correct_answer' => $pathAnswers . '/' . basename($correct_answer),
                'answer2' => $pathAnswers . '/' . basename($answer2),
                'answer3' => $pathAnswers . '/' . basename($answer3),
                'answer4' => $pathAnswers . '/' . basename($answer4),
                'category_id' => $request->category_id,
                'active' => $request->active
            ]);
        } else
            $save = Question::create($request->all());

        if ($save)
            return redirect()->route('question.index')->with(['success' => Lang::get('lang.addSuccess')]);
        else
            return redirect()->route('question.index')->with(['error' => Lang::get('lang.addError')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $categories = Category::all();
        return view('dashboard.question.edit', compact(['question', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $path = 'images/questions';
        $pathAnswers = 'images/questions/answers';
        $validate = $request->validate([
            'question' => 'required',
            'with_image' => 'required',
            'category_id' => 'required',
            'active' => 'required'
        ]);

        if ($question->with_image == 0) {
            $validate = $request->validate([
                'correct_answer' => 'required',
                'answer2' => 'required',
                'answer3' => 'required',
                'answer4' => 'required',
            ]);
        } else {
        }
        if ($question->with_image == 1 && $request->with_image == 0) {
            if (!File::exists('public/' . $question->image))
                Storage::delete('public/' . $question->image);
            if (!File::exists('public/' . $question->correct_answer))
                Storage::delete('public/' . $question->correct_answer);
            if (!File::exists('public/' . $question->answer2))
                Storage::delete('public/' . $question->answer2);
            if (!File::exists('public/' . $question->answer3))
                Storage::delete('public/' . $question->answer3);
            if (!File::exists('public/' . $question->answer4))
                Storage::delete('public/' . $question->answer4);

            $save = $question->update($request->all());
        }
        if ($request->with_image == 1 && $question->with_image == 1) {
            $image = $question->image;
            $correct_answer = $question->correct_answer;
            $answer2 = $question->answer2;
            $answer3 = $question->answer3;
            $answer4 = $question->answer4;
            if ($request->file('image')) {
                if (!File::exists('public/' . $question->image))
                    Storage::delete('public/' . $question->image);
                $saveImage = $request->file('image')->store('public/' . $path);
                $image = $path . '/' . basename($saveImage);
            }
            if ($request->file('correct_answer')) {
                if (!File::exists('public/' . $question->correct_answer))
                    Storage::delete('public/' . $question->correct_answer);
                $saveImage = $request->file('correct_answer')->store('public/' . $pathAnswers);
                $correct_answer = $path . '/' . basename($saveImage);
            }
            if ($request->file('answer2')) {
                if (!File::exists('public/' . $question->answer2))
                    Storage::delete('public/' . $question->answer2);
                $saveImage = $request->file('answer2')->store('public/' . $pathAnswers);
                $answer2 = $path . '/' . basename($saveImage);
            }
            if ($request->file('answer3')) {
                if (!File::exists('public/' . $question->answer3))
                    Storage::delete('public/' . $question->answer3);
                $saveImage = $request->file('answer3')->store('public/' . $pathAnswers);
                $answer3 = $path . '/' . basename($saveImage);
            }
            if ($request->file('answer4')) {
                if (!File::exists('public/' . $question->answer4))
                    Storage::delete('public/' . $question->answer4);
                $saveImage = $request->file('answer3')->store('public/' . $pathAnswers);
                $answer3 = $path . '/' . basename($saveImage);
            }
            $question->question = $request->question;
            $question->with_image = $request->with_image;
            $question->image = $image;
            $question->correct_answer = $correct_answer;
            $question->answer2 = $answer2;
            $question->answer3 = $answer3;
            $question->answer4 = $answer4;
            $question->category_id = $request->category_id;
            $question->active = $request->active;
            $save = $question->save();
        }
        if ($request->with_image == 0 && $question->with_image == 0)
            $save = $question->update($request->all());

        if ($save)
            return redirect()->route('question.index')->with(['success' => Lang::get('lang.updateSuccess')]);
        else
            return redirect()->route('question.index')->with(['error' => Lang::get('lang.updateError')]);
    }

    /**
     * Move to Trash.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        if ($question->delete())
            return redirect()->back()->with(['success' => Lang::get('lang.deleteSuccess')]);
        else
            return redirect()->back()->with(['error' => Lang::get('lang.deleteError')]);
    }

    /**
     * Show questions deleted.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $questions = Question::onlyTrashed()->get();
        return view('dashboard.question.trash', compact(['questions']));
    }

    /**
     * Return to storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function undo($id)
    {
        $category = Question::onlyTrashed()->where('id', $id)->first();
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
        $question = Question::onlyTrashed()->where('id', $id)->first();

        if ($question->with_image) {
            if (!File::exists('public/' . $question->image))
                Storage::delete('public/' . $question->image);
            if (!File::exists('public/' . $question->correct_answer))
                Storage::delete('public/' . $question->correct_answer);
            if (!File::exists('public/' . $question->answer2))
                Storage::delete('public/' . $question->answer2);
            if (!File::exists('public/' . $question->answer3))
                Storage::delete('public/' . $question->answer3);
            if (!File::exists('public/' . $question->answer4))
                Storage::delete('public/' . $question->answer4);
        }
        if ($question->forceDelete())
            return redirect()->back()->with(['success' => Lang::get('lang.deleteSuccess')]);
        else
            return redirect()->back()->with(['error' => Lang::get('lang.deleteError')]);
    }

    /**
     * Active and inactive questions.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function active(Question $question)
    {
        $question->active = !$question->active;
        if ($question->save())
            return redirect()->back()->with(['success' => Lang::get('lang.updateSuccess')]);
        else
            return redirect()->back()->with(['error' => Lang::get('lang.updateError')]);
    }

    /**
     * Show question inactive.
     *
     * @return \Illuminate\Http\Response
     */
    public function inactive()
    {
        $questions = Question::where('active', 0)->get();
        return view('dashboard.question.view', compact(['questions']));
    }
}
