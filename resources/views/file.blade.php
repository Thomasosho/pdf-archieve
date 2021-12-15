@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 px-5 py-3">
                    <h2>Sample Demonstration</h2>
                    <p>Upload multiple Documents</p>
                </div>
                <div class="col-md-12 px-5">
                    <form action="/save" enctype="multipart/form-data" method="POST">
                        {{ csrf_field() }}
                        <div class="row g-3 py-2">
                            <div class="col-sm">
                                <input type="date" class="form-control" name="date" placeholder="Date" aria-label="Date">
                            </div>
                            <div class="col-sm">
                                <input type="text" class="form-control" name="keyword" placeholder="Keywords" aria-label="keywords seperated by commas">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="file" name="files[]" multiple accept=".docx,.pdf" class="form-control">
                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
                        </div>
                        <button class="form-control" type="submit">submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
@endsection