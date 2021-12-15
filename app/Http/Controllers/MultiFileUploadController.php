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

class MultiFileUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        
        $request->validate([
            'files' => 'required|unique:files,file',
            'files.*' => 'mimes:pdf,docx,docx'
            ]);

        if($request->hasfile('files'))
        {
            foreach($request->file('files') as $key => $file)
            {
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

                if ($file->getClientOriginalExtension() != 'pdf') {
                    if ($file->getClientOriginalExtension() == 'DOCX'||'docx') {
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

                if($file){
                    // Get filename with the extension
                    $filenameWithExt = $file->getClientOriginalName();
                    // Get just filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    // Get just ext
                    $extension = $file->getClientOriginalExtension();
                    // Filename to store
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    // Upload Image
                    $path = $file->storeAs('public/documents', $fileNameToStore);
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
                $upload_file->file = $fileNameToStore;
                $upload_file->save();
            }
            return back()->with('success', 'Files saved');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
