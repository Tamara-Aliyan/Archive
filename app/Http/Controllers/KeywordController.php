<?php

namespace App\Http\Controllers;

use toastr;
use App\Models\Keyword;
use Illuminate\Http\Request;

class KeywordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keywords= Keyword::all();
        return view('admin.keyword.index',compact('keywords'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $keyword = new Keyword();
            $keyword->name = $request->name ;
            $keyword->save();
            toastr()->success('Data has been saved successfully!');
            return redirect()->route('k_index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        try {
            $keyword = Keyword::findOrFail($request->id);
            $keyword->update([
                $keyword->name=$request->name
            ]);
            toastr()->success('Data has been updated successfully!');
            return redirect()->route('k_index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try{
            $keyword = Keyword::findOrFail($request->id)->delete();
            toastr()->success('Data has been deleted successfully!');
            return redirect()->route('k_index');
        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
