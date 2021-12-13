@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8 p-5">
                    <h2>Sample Demonstration</h2>
                    <p>Upload Document File</p>
                </div>
                <div class="col-md-7 px-5">
                    <form action="/store" enctype="multipart/form-data" method="POST">
                        {{ csrf_field() }} @csrf
                        <div class="row g-3 py-2">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="class" placeholder="Class" aria-label="Class">
                            </div>
                            <div class="col-sm">
                                <input type="date" class="form-control" name="date" placeholder="Date" aria-label="Date">
                            </div>
                            <div class="col-sm">
                                <input type="text" class="form-control" name="account" placeholder="Account" aria-label="Account">
                            </div>
                            <div class="col-sm">
                                <select name="category" class="form-control" id="">
                                    <option dissbled selected>--select category--</option>
                                    @foreach($category as $cat)
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm">
                                <select name="privacy" class="form-control" id="">
                                    <option value="all" selected>--select privacy--</option>
                                    @foreach($category as $cat)
                                    <option value="all">All</option>
                                    <option value="me">Me</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row g-3 py-2">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="person" placeholder="Person Responsible" aria-label="Person Responsible">
                            </div>
                            <div class="col-sm">
                                <input type="text" class="form-control" name="keyword" placeholder="keywords seperated by commas" aria-label="keywords seperated by commas">
                            </div>
                            <div class="col-sm">
                                <input type="text" class="form-control" name="description" placeholder="Description" aria-label="Description">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="file" name="file" accept=".doc,.docx,.pdf,.ppt,.pptx,.ods,.odt,.odp,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" class="form-control" id="inputGroupFile02">
                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
                        </div>
                        <button class="form-control" type="submit">submit</button>
                    </form>
                </div>
                <div class="col-md-5">
                    <h3>Recent Uploads
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Launch demo modal
                        </button>
                    </h3>
                    <table class="table text-center">
                        <thead>
                            <th>#Id</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>File Type</th>
                            <th>Privacy</th>
                            <th>Date</th>
                        </thead>
                        <tbody>
                            @if($searchs->count())
                                @foreach($searchs as $key => $s)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{$s->orig_filename}}</td>
                                        <td>{{$s->orig_filename}}</td>
                                        <td>{{$s->privacy}}</td>
                                        <td>{{$s->date->diffForHumans()}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">There are no data.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    
@endsection