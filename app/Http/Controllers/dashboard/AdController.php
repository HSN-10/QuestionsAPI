<?php

namespace App\Http\Controllers\dashboard;

use App\Ad;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Ad::all();
        return view('dashboard.ad.view', compact(['ads']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.ad.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path = 'images/ads';
        $validate = $request->validate([
            'name' => 'required',
            'image' => 'required|image',
            'url' => 'required|url',
            'active' => 'required',
        ]);
        $saveImage = $request->file('image')->store('public/' . $path);
        $save = Ad::create([
            'name' => $request->name,
            'image' => $path . '/' . basename($saveImage),
            'url' => $request->url,
            'active' => $request->active
        ]);

        if ($save)
            return redirect()->route('ad.index')->with(['success' => Lang::get('lang.addSuccess')]);
        else
            return redirect()->route('ad.index')->with(['error' => Lang::get('lang.addError')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Ad $ad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function edit(Ad $ad)
    {
        return view('dashboard.ad.edit', compact(['ad']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ad $ad)
    {
        $path = 'images/ads';
        $validate = $request->validate([
            'name' => 'required',
            'image' => 'image',
            'url' => 'required|url',
            'active' => 'required',
        ]);

        if ($request->file('image')) {
            if (!File::exists('public/' . $ad->image))
                Storage::delete('public/' . $ad->image);
            $saveImage = $request->file('image')->store('public/' . $path);
            $ad->image = $path . '/' . basename($saveImage);
        }
        $ad->name = $request->name;
        $ad->url = $request->url;
        $ad->active = $request->active;
        if ($ad->save())
            return redirect()->route('ad.index')->with(['success' => Lang::get('lang.updateSuccess')]);
        else
            return redirect()->route('ad.index')->with(['error' => Lang::get('lang.updateError')]);
    }

    /**
     * Move to Trash.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $ad)
    {
        if ($ad->delete())
            return redirect()->back()->with(['success' => Lang::get('lang.deleteSuccess')]);
        else
            return redirect()->back()->with(['error' => Lang::get('lang.deleteError')]);
    }

    /**
     * Show ads deleted.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $ads = Ad::onlyTrashed()->get();
        return view('dashboard.ad.trash', compact(['ads']));
    }

    /**
     * Return to storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function undo($id)
    {
        $ad = Ad::onlyTrashed()->where('id', $id)->first();
        $ad->deleted_at = null;
        if ($ad->save())
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
        $ad = Ad::onlyTrashed()->where('id', $id)->first();

        if (!File::exists('public/' . $ad->image))
            Storage::delete('public/' . $ad->image);

        if ($ad->forceDelete())
            return redirect()->back()->with(['success' => Lang::get('lang.deleteSuccess')]);
        else
            return redirect()->back()->with(['error' => Lang::get('lang.deleteError')]);
    }

    /**
     * Active and inactive ad.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function active(Ad $ad)
    {
        $ad->active = !$ad->active;
        if ($ad->save())
            return redirect()->back()->with(['success' => Lang::get('lang.updateSuccess')]);
        else
            return redirect()->back()->with(['error' => Lang::get('lang.updateError')]);
    }
}
