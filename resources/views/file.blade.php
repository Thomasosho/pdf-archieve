@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 px-5 py-3">
                    <h2>Add new documents</h2>
                    <p>Upload multiple documents</p>
                </div>
                <div class="col-md-12 px-5">
                    <form action="/save" enctype="multipart/form-data" method="POST">
                        {{ csrf_field() }}
                        <div class="input-group mb-3">
                            <select name="category_id" class="form-control" searchable="Search here..">
                                <option value="" disabled selected>Choose folder</option>
                                @foreach($category as $c)
                                    <option value="{{$c->id}}">&#xf07c; {{$c->name}} @if($c->pin != null) &#xf023; @endif</option>
                                @endforeach
                            </select>
                            <button class="input-group-text" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-folder-plus px-2"></i> Create Folder</button>
                        </div>
                        <div class="row g-3 py-2">
                            <div class="col-sm">
                                <input type="date" class="form-control" name="date" placeholder="Date" aria-label="Date">
                            </div>
                            <div class="col-sm">
                                <input type="text" class="form-control" name="keyword" placeholder="Keywords" aria-label="keywords">
                            </div>
                            <div class="col-sm">
                                <input type="text" class="form-control" name="person" placeholder="Created by" aria-label="created by">
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