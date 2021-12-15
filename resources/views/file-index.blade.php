@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="accordion" id="accordionExample">
                @if($sort->count())
                    @foreach($sort as $date => $items )
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{$date}}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$date}}" aria-expanded="false" aria-controls="collapse{{$date}}">
                                    {{$date}}
                                </button>
                            </h2>
                            <div id="collapse{{$date}}" class="accordion-collapse collapse" aria-labelledby="heading{{$date}}" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <table class="table text-center">
                                        <thead>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>File Type</th>
                                            <th>Date</th>
                                            <th>Action(s)</th>
                                        </thead>
                                        <tbody>
                                            @foreach($items as $key => $item )
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{$item->orig_filename}}</td>
                                                    <td>{{$item->extension}}</td>
                                                    <td>{{$item->created_at->diffForHumans()}}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                Action
                                                            </button>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                <li>
                                                                    <a href="/download/{{$item->file}}" download="{{$item->file}}" class="dropdown-item decorate" style="float:left;" data-toggle="tooltip" data-original-title="Edit">
                                                                        <i class="fas fa-file-download"></i> Download
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ route('file.show',$item->id)}}" class="dropdown-item decorate" style="float:left;" data-toggle="tooltip" data-original-title="Edit">
                                                                        <i class="fas fa-binoculars"></i> View
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item decorate" href="{{ route('file.edit',$item->id)}}" style="float:left;" data-toggle="tooltip" data-original-title="Edit">
                                                                        <i class="fas fa-spell-check"></i> Edit
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <form class="dropdown-item decorate" action="{{ route('file.destroy', $item->id)}}"  method="post" data-toggle="tooltip" data-original-title="Delete">
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
                                </div>
                            </div>
                        </div>
                    @endforeach
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