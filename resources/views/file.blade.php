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
                        {{ csrf_field() }}
                        <div class="row g-3 py-2">
                            <div class="col-sm">
                                <input type="date" class="form-control" name="date" placeholder="Date" aria-label="Date">
                            </div>
                            <div class="col-sm">
                                <input type="text" class="form-control" name="keyword" placeholder="Keywords" aria-label="keywords seperated by commas">
                            </div>
                        </div>
                        <div class="row g-3 py-2">
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
                    </h3>
                    <table class="table text-center">
                        <thead>
                            <th>#Id</th>
                            <th>Name</th>
                            <th>File Type</th>
                            <th>Date</th>
                            <th>Action(s)</th>
                        </thead>
                        <tbody>
                            @if($searchs->count())
                                @foreach($searchs as $key => $s)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{$s->orig_filename}}</td>
                                        <td>{{$s->extension}}</td>
                                        <td>{{$s->created_at->diffForHumans()}}</td>
                                        <td>
                                            <a href="/download/{{$s->file}}" class="px-2 decorate" style="float:left;" data-toggle="tooltip" data-original-title="Edit">
                                                <i class="fas fa-file-download"></i> Download
                                            </a>
                                            <a href="{{ route('file.show',$s->id)}}" class="px-2 decorate" style="float:left;" data-toggle="tooltip" data-original-title="Edit">
                                                <i class="fas fa-binoculars"></i> View
                                            </a>
                                            <a class="decorate" href="{{ route('file.edit',$s->id)}}" style="float:left;" data-toggle="tooltip" data-original-title="Edit">
                                                <i class="fas fa-spell-check"></i> Edit
                                            </a>
                                            <form class="decorate" action="{{ route('file.destroy', $s->id)}}" style="margin-left : 18px;float:left;"  method="post" data-toggle="tooltip" data-original-title="Delete">
                                                {{ csrf_field() }}
                                                @method('DELETE')    
                                                <button style="border:0px;" class="fas fa-trash text-danger" type="submit"> Delete</button> 
                                            </form>
                                        </td>
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