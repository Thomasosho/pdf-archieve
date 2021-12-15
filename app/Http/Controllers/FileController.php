<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Category;
use DB;
use Response;
use Illuminate\Support\Facades\Storage;
use Smalot\PdfParser\Parser;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:file-list', ['only' => ['index']]);
        $this->middleware('permission:file-create', ['only' => ['create','store']]);
        $this->middleware('permission:file-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:file-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('q')){
            $searchs = File::search($request->q)
                ->orderBy('created_at','desc')->paginate(50);
        }else{
            $searchs = File::orderBy('created_at','desc')->paginate(50);
        }

        return view('file', compact('searchs'));
    }

    public function fil(File $file, Request $request)
    {
        $pagination =File::latest()->paginate(50);
        $sort = collect($pagination->items())->groupBy(function($item)
        {
            return $item->date;
        });

        if($request->has('q')){
            $searchs = File::search($request->q)
            ->orderBy('created_at','desc')->paginate(7);
        }else{
            $searchs = File::orderBy('created_at','desc')->paginate(7);
        }

        return view('file-index', compact('sort', 'searchs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = Carbon::now();

        $file = $request->file;

        $request->validate([
            'file' => 'required|unique:files|mimes:doc,pdf,docx,xlsx,docx,ppt,pptx,ods,odt,odp',
        ]);

        // use of pdf parser to read content from pdf 
        $fileName = $file->getClientOriginalName();

        if ( File::where('orig_filename', $fileName)->first() ) {
            // $error = \Illuminate\Validation\ValidationException::withMessages([
            //      'file' => 'File already exists'
            // ]);
            return back()->with('error', 'File already exists');  
            // throw $error;
        }

        if ($file->getMimeType() == 'application/pdf') {
            $pdfParser = new Parser();
            $pdf = $pdfParser->parseFile($file->path());
            $content = $pdf->getText();
        }
        else {
            $content = 'null';
        }

        if ($request->file('file')->getClientOriginalExtension() != 'pdf') {
            if ($request->file('file')->getClientOriginalExtension() == 'DOCX'||'docx') {
                $zip = zip_open($file);

                if (!$zip || is_numeric($zip)) return false;

                while ($zip_entry = zip_read($zip)) {

                    if (zip_entry_open($zip, $zip_entry) == FALSE) continue;

                    if (zip_entry_name($zip_entry) != "word/document.xml") continue;

                    $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
                    zip_entry_close($zip_entry);
                } // end while

                zip_close($zip);
            }
        }

        if($request->hasFile('file')){
            // Get filename with the extension
            $filenameWithExt = $request->file('file')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('file')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('file')->storeAs('public/documents', $fileNameToStore);
        }

        $date = Carbon::now();

        $upload_file = new File;
        $upload_file->orig_filename = $fileName;
        $upload_file->mime_type = $file->getMimeType();
        $upload_file->filesize = $file->getSize();
        $upload_file->content = $content;
        $upload_file->extension = $extension;
        if ($request->input('date') != NULL) {
            $upload_file->date = $request->input('date');
        }
        else {
            $upload_file->date = $date->toDateString();
        }
        $upload_file->person = auth()->user()->name;
        $upload_file->keyword = $request->input('keyword');
        $upload_file->description = $request->input('description');
        $upload_file->file = $fileNameToStore;
        $upload_file->save();
        return back()->with('success', 'File saved');   
    }

    public function download($file)
    {
        // /app/storage/app/public
        // $doc = File::find($id);
        // //PDF file is stored under project/public/download/info.pdf
        // $file= $doc->file;
        // return Response::download($file);
        return response()->download(Storage::disk('public')->path("documents".DIRECTORY_SEPARATOR.$file));
    }

    public function type(File $file, Request $request)
    {
        $sort = File::latest()->get()->groupBy(function($item)
        {
            return $item->extension;
        });

        if($request->has('q')){
            $searchs = File::search($request->q)
                ->paginate(7);
        }else{
            $searchs = File::paginate(7);
        }

        return view('type', compact('sort', 'searchs'));
    }

    public function date(File $file, Request $request)
    {
        $sort = File::latest()->get()->groupBy(function($item)
        {
            return $item->date;
        });

        if($request->has('q')){
            $searchs = File::search($request->q)
                ->paginate(7);
        }else{
            $searchs = File::paginate(7);
        }

        return view('date', compact('sort', 'searchs'));
    }

    public function search(Request $request)
    {
        $q = $request->get ( 'q' );

        $searchs = File::where('orig_filename', 'like', '%' . $q . '%')
            ->orWhere('file', 'like', '%' . $q . '%')
            ->orWhere('date', 'like', '%' . $q . '%')
            ->orWhere('person', 'like', '%' . $q . '%')
            ->orWhere('keyword', 'like', '%' . $q . '%')
            ->orWhere('extension', 'like', '%' . $q . '%')
            ->orWhere('description', 'like', '%' . $q . '%')
            ->orWhere('content', 'like', '%' . $q . '%')
            ->paginate(50);

        return view('search', compact('searchs'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        return view('show', compact('file'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        return view('edit', compact('file'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->has('file')) {
            $file = $request->file;

            $request->validate([
                'file' => 'required|unique:files|mimes:doc,pdf,docx,xlsx,docx,ppt,pptx,ods,odt,odp',
            ]);

            // use of pdf parser to read content from pdf 
            $fileName = $file->getClientOriginalName();

            if ( File::where('orig_filename', $fileName)->first() ) {
                // $error = \Illuminate\Validation\ValidationException::withMessages([
                //      'file' => 'File already exists'
                // ]);
                return back()->with('error', 'File already exists');  
                // throw $error;
            }

            if ($file->getMimeType() == 'application/pdf') {
                $pdfParser = new Parser();
                $pdf = $pdfParser->parseFile($file->path());
                $content = $pdf->getText();
            }
            else {
                $content = 'null';
            }

            if ($request->file('file')->getClientOriginalExtension() != 'pdf') {
                if ($request->file('file')->getClientOriginalExtension() == 'DOCX'||'docx') {
                    $zip = zip_open($file);

                    if (!$zip || is_numeric($zip)) return false;

                    while ($zip_entry = zip_read($zip)) {

                        if (zip_entry_open($zip, $zip_entry) == FALSE) continue;

                        if (zip_entry_name($zip_entry) != "word/document.xml") continue;

                        $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
                        zip_entry_close($zip_entry);
                    } // end while

                    zip_close($zip);
                }
            }

            if($request->hasFile('file')){
                // Get filename with the extension
                $filenameWithExt = $request->file('file')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('file')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                // Upload Image
                $path = $request->file('file')->storeAs('public/documents', $fileNameToStore);
            }
            $date = Carbon::now();

            $upload_file = File::find($id);
            $upload_file->orig_filename = $fileName;
            $upload_file->mime_type = $file->getMimeType();
            $upload_file->filesize = $file->getSize();
            $upload_file->content = $content;
            $upload_file->extension = $extension;
            if ($request->input('date') != NULL) {
                $upload_file->date = $request->input('date');
            }
            else {
                $upload_file->date = $date->toDateString();
            }
            $upload_file->person = auth()->user()->name;
            $upload_file->keyword = $request->input('keyword');
            $upload_file->description = $request->input('description');
            // $upload_file->category_id = $request->input('category');
            // $upload_file->privacy = $request->input('privacy');
            $upload_file->file = $fileNameToStore;
            $upload_file->save();
            return back()->with('success', 'File updated');

        }
        else {
            $date = Carbon::now();
            $upload_file = File::find($id);
            $upload_file->class = $request->input('class');
            if ($request->has('date')) {
                $upload_file->date = $request->input('date');
            }
            else {
                $upload_file->date = $date->toDateString();
            }
            $upload_file->account = $request->input('account');
            $upload_file->person = $request->input('person');
            $upload_file->keyword = $request->input('keyword');
            $upload_file->description = $request->input('description');
            $upload_file->save();
            return back()->with('success', 'File updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = File::find($id);
        $file->delete();
        return back()->with('success', 'deleted successfully');
    }
}
