@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md">
                    <h3>Recent Uploads
                    </h3>
                    <table class="table text-center">
                        <thead>
                            <th>Name</th>
                            <th>File Type</th>
                            <th>Date</th>
                            <th>Action(s)</th>
                        </thead>
                        <tbody>
                            @if($sort->count())
                                @foreach($sort as $date => $s )
                                    <tr>
                                        {{$date}}
                                        <td>{{$s->orig_filename}}</td>
                                        <td>{{$s->extension}}</td>
                                        <td>{{$s->date->diffForHumans()}}</td>
                                        <td>
                                        <a href="{{ route('file.show',$i->id)}}" style="float:left;" data-toggle="tooltip" data-original-title="Edit">
                                                <i class="fas fa-pencil-alt text-inverse mr-2"></i> Edit
                                            </a>
                                            <a href="{{ route('file.edit',$i->id)}}" style="float:left;" data-toggle="tooltip" data-original-title="Edit">
                                                <i class="fas fa-pencil-alt text-inverse mr-2"></i> Edit
                                            </a>
                                            <form action="{{ route('file.destroy', $i->id)}}" style="margin-left : 20px;float:left;"  method="post" data-toggle="tooltip" data-original-title="Delete">
                                                {{ csrf_field() }}
                                                @method('DELETE')    
                                                <button style="border:0px;" class="fas fa-window-close text-danger" type="submit"> Delete</button> 
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