@extends('layouts.app')

@section('content')
    <div class="col-md-12">
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
@endsection