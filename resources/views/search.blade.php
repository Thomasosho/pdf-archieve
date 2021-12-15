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
                            @else
                                <tr>
                                    <td colspan="4">There are no data.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                {!! $searchs->links() !!}
            </div>
        </div>
    </section>
        
@endsection