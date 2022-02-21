@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                @if($files->count() != 0)
                <div class="col">
                    <table class="table text-center">
                        <thead>
                            <th>No</th>
                            <th>Name</th>
                            <th>File Volume</th>
                            <th>Unit/Formation</th>
                            <th>File Reference</th>
                            <th>File Type</th>
                            <th>Open Date</th>
                            <th>Close Date</th>
                            <th>Action(s)</th>
                        </thead>
                        <tbody>
                            @foreach($files as $key => $s )
                            <!-- Move Modal -->
                            <div class="modal fade" id="moveModal" tabindex="-1" aria-labelledby="moveModalLabel" aria-hidden="true">

                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Move to Folder {{$s->id}}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('move.update', $s->id) }}" method="post">
                                                {{ csrf_field() }}
                                                @method('PATCH')
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <label for="name">Select File Volume</label>
                                                        <select name="category_id" class="form-control" searchable="Search here..">
                                                            <option value="" disabled selected>Choose Volume</option>
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
                                <tr>
                                    <td>{{ ($files->currentPage()-1) * $files->perPage() + $loop->iteration }}</td>
                                    <td>{{$s->orig_filename}}</td>
                                    <td>@if($s->folder != null) {{$s->folder}} @else Uncategorized @endif</td>
                                    <td>{{$s->unit}}</td>
                                    <td>{{$s->reference}}</td>
                                    <td>{{$s->extension}}</td>
                                    <td>{{date('d-m-Y', strtotime($s->opendate))}}</td>
                                    <td>{{date('d-m-Y', strtotime($s->closedate))}}</td>

                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                Action
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li>
                                                    <a href="/download/{{$s->file}}" download="{{$s->file}}" class="dropdown-item decorate" style="float:left;" data-toggle="tooltip" data-original-title="Edit">
                                                        <i class="fas fa-file-download"></i> Download
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('file.show',$s->id)}}" class="dropdown-item decorate" style="float:left;" data-toggle="tooltip" data-original-title="Edit">
                                                        <i class="fas fa-binoculars"></i> View
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item decorate" href="{{ route('file.edit',$s->id)}}" style="float:left;" data-toggle="tooltip" data-original-title="Edit">
                                                        <i class="fas fa-spell-check"></i> Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <form class="dropdown-item decorate" action="{{ route('file.destroy', $s->id)}}"  method="post" data-toggle="tooltip" data-original-title="Delete">
                                                        {{ csrf_field() }}
                                                        @method('DELETE')    
                                                        <button style="border:0px;" class="fas fa-trash text-danger" type="submit"> Delete</button> 
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$files->links()}}

                    @else
                        <p>
                            There are no data.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </section>
    
@endsection