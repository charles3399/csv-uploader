<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Imports\FileImport; //File import class for csv upload functionality (Laravel Excel Package)
use App\Models\FileUpload;
use Maatwebsite\Excel\Facades\Excel;

class FileUploadController extends Controller
{
    public function index() {
        return view('upload');
    }

    public function uploadFile(Request $request) { //upload function for the csv file
        $request->validate([
            'file' => 'required|file|mimes:csv' //validate if file is csv format
        ]);
        $filename = $request->file('file')->getClientOriginalName();

        $csv_file = $request->file('file');

        $file_exists = FileUpload::where('id', '>', 0)->exists();

        if($file_exists) {
            FileUpload::where('id', '>', 0)->delete();
            DB::statement("ALTER TABLE file_uploads AUTO_INCREMENT =  1"); //auto increment id to 1
            Excel::import(new FileImport, $csv_file);
        }
        else {
            DB::statement("ALTER TABLE file_uploads AUTO_INCREMENT =  1"); //auto increment id to 1
            Excel::import(new FileImport, $csv_file);
        }

        return redirect('/')->with('success', "File($filename) imported!");
    }

    public function showTable() { //show all the contents of the csv file
        $records = FileUpload::paginate(10);

        if(count($records) > 0) {
            return view('table')->with('records', $records);
        }
        else {
            return redirect('/')->with('warning', 'No file has been submitted yet, please insert a csv file');
        }
    }

    public function search(Request $request) { //search function
        $search = $request->input('search');

        $posts = FileUpload::query()
                        ->where('year', 'LIKE', "{$search}")
                        ->orWhere('rank', 'LIKE', "%{$search}%")
                        ->orWhere('recipient', 'LIKE', "%{$search}%")
                        ->orWhere('country', 'LIKE', "%{$search}%")
                        ->orWhere('career', 'LIKE', "%{$search}%")
                        ->orWhere('tied', 'LIKE', "%{$search}%")
                        ->orWhere('title', 'LIKE', "%{$search}%")
                        ->paginate(10);

       if($search == null || $search == ' ') {
           return redirect()->back()->with('warning', 'Must not be an empty input');
       }
       else {
            return view('search')
            ->with('posts', $posts);
       }
    }

    public function filterBy(Request $request) { //filter function
       $selected = $request->input('sort');

       if($selected == 'year' || $selected == 'rank' || $selected == 'tied') {
           $sorts = FileUpload::orderBy($selected, 'asc')->paginate(10);
       }
       else {
           $sorts = FileUpload::orderBy($selected)->paginate(10);
       }

        return view('sort')
        ->with('sorts', $sorts);
    }
}
