<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use App\Models\Keyword;
use Illuminate\Http\Request;
use App\Http\Requests\FileRequest;
use Illuminate\Support\Facades\Storage;


class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $files=File::all();
        $keywords=Keyword::all();
        $users=User::all();
        return view('admin.file.index',compact('files','keywords','users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function search(Request $request)
    {

        $search = $request->search;

        $keywords = Keyword::all();
        $users = User::all();
        $files = File::where(function($query) use ($search){
            $query->where('subject','like',"%$search%")
            ->orWhere('filedate','like',"%$search%");
        })
        ->orWhereHas('keyword',function($query) use ($search){
            $query->where('name','like',"%$search%");
        })
        ->orWhereHas('user',function($query) use ($search){
            $query->where('name','like',"%$search%");
        })
        ->get();
    return view('admin.file.index',compact('files','search','keywords','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FileRequest $request)
    {
        try {
            $file=new File();

            $filepath=$request->filepath;
                $filename=time().'.'.$filepath->getClientOriginalExtension();
                $request->filepath->move('assets/uploads',$filename);
                $file->filepath=$filename;

            $file->subject=$request->subject;
            $file->filedate=$request->filedate;
            $file->user_id=$request->user_id;
            $file->keyword_id =$request->keyword_id;
            $file->save();
            toastr()->success(trans('Data has been saved successfully!'));
            return redirect()->route('f_index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function download(Request $request,$filepath)
    {
        return response()->download(public_path('assets/uploads/'.$filepath));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $file = File::findOrFail($id);
        return view('admin.file.show',compact('file'));
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
            $file = File::find($request->id);

            if (!$file) {
                throw new \Exception('File not found');
            }

            // Update file properties
            $file->subject = $request->input('subject');
            $file->filedate = $request->input('filedate');
            $file->save();

            // Check if a new file is uploaded
            if ($request->hasFile('file')) {
                $uploadedFile = $request->file('file');
                $filename = time() . '.' . $uploadedFile->getClientOriginalExtension();

                // Remove the existing file
                Storage::delete('assets/uploads/' . $file->filepath);

                // Save the new file
                $uploadedFile->storeAs('assets/uploads', $filename);
                $file->filepath = $filename;
                $file->save(); // Update the file record with the new filepath
            }

            toastr()->success(trans('Data has been updated successfully!'));
            return redirect()->route('f_index');
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
            $file = File::findOrFail($request->id)->delete();
            toastr()->success('Data has been deleted successfully!');
            return redirect()->route('f_index');
        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
