@extends('layouts.app')

@section('content')
<style>
    .full {
        height: 100vh !important;
    }
</style>
<section>
    <div class="container">
        <div class="row">
            <div class="modal fade" id="moveModal" tabindex="-1" aria-labelledby="moveModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Move to Folder</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('move.update', $file->id) }}" method="post">
                                {{ csrf_field() }}
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-sm">
                                        <label for="name">Select Folder</label>
                                        <select name="category_id" class="form-control" searchable="Search here..">
                                            <option value="" disabled selected>Choose folder</option>
                                                @foreach($category as $c)
                                                    <option value="{{$c->id}}">&#xf07c; {{$c->name}} @if($c->pin != null) &#xf023; @endif</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm my-3">
                                        <button class="form-control btn btn-primary" type="submit">Move</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 margin-tb">
                <div class="pull-left">
                    <a class="btn btn-primary" href="/files"> Back</a>
                </div>
            </div>
            <div class="col-lg-5 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#moveModal">
                        <i class="fas fa-folder-open"></i> Move
                    </a>
                </div>
            </div>
            <div class="col-lg-2 margin-tb">
                <div class="pull-left">
                    <a class="btn btn-success" href="{{ route('file.edit',$file->id)}}"> Edit</a>
                </div>
            </div>
        </div>
        <br>
        <h3>{{$file->file}}</h3>
        <div class="row g-3 py-2">
            <div class="col-sm">
                <label for="date">Date</label>
                <input type="text" class="form-control" value="{{$file->date}}" aria-label="Date" readonly>
            </div>
            <div class="col-sm-4">
                <label for="person">Folder</label>
                <input type="text" class="form-control" value="@if($file->pin != null) &#xf023; @endif {{$file->folder}}" aria-label="Folder" readonly>
            </div>
            <div class="col-sm-4">
                <label for="person">Created By</label>
                <input type="text" class="form-control" value="{{$file->person}}" aria-label="Created By" readonly>
            </div>
        </div>
        <!-- <div class="row g-3 py-2">
            <div class="col-sm">
                <label for="description">Description</label>
                <input type="text" class="form-control" value="{{$file->description}}" aria-label="Description" readonly>
            </div>
        </div> -->
        <br>
        <div class="row">
            <div class="col-md">
                @if($file->extension == 'pdf'||$file->extension == 'PDF')
                    <h5>Preview <span>{{$file->file}}</span></h5>
                    <iframe
                        src="/storage/documents/{{$file->file}}"
                        frameBorder="0"
                        scrolling="auto"
                        width="100%"
                        class="full"
                    ></iframe>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection