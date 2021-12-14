@extends('layouts.app')

@section('content')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8 py-3 px-5">
                    <h2>Sample Demonstration</h2>
                    <p>Search Result(s):</p>
                </div>
                <div class="col-md-8 px-5">
                    <table class="table text-center">
                        <thead>
                            <th>#Id</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Action(s)</th>
                        </thead>
                        <tbody>
                            @if($searchs->count())
                                @foreach($searchs as $key => $s)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{$s->orig_filename}}</td>
                                        <td>{{$s->date}}</td>
                                        <td>
                                            <a href="/download/{{$s->file}}" download="{{$s->file}}" class="px-2" style="float:left;" data-toggle="tooltip" data-original-title="Edit">
                                                <i class="fas fa-pencil-alt text-inverse mr-2"></i> Download
                                            </a>
                                            <a href="{{ route('file.show',$s->id)}}" class="px-2" style="float:left;" data-toggle="tooltip" data-original-title="Edit">
                                                <i class="fas fa-pencil-alt text-inverse mr-2"></i> View
                                            </a>
                                            <a href="{{ route('file.edit',$s->id)}}" style="float:left;" data-toggle="tooltip" data-original-title="Edit">
                                                <i class="fas fa-pencil-alt text-inverse mr-2"></i> Edit
                                            </a>
                                            <form action="{{ route('file.destroy', $s->id)}}" style="margin-left : 18px;float:left;"  method="post" data-toggle="tooltip" data-original-title="Delete">
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