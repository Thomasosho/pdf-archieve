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
                                                        <a href="/download/{{$item->orig_filename}}" class="px-2" style="float:left;" data-toggle="tooltip" data-original-title="Edit">
                                                            <i class="fas fa-pencil-alt text-inverse mr-2"></i> Download
                                                        </a>
                                                        <a href="{{ route('file.show',$item->id)}}" class="px-2" style="float:left;" data-toggle="tooltip" data-original-title="Edit">
                                                            <i class="fas fa-pencil-alt text-inverse mr-2"></i> View
                                                        </a>
                                                        <a href="{{ route('file.edit',$item->id)}}" style="float:left;" data-toggle="tooltip" data-original-title="Edit">
                                                            <i class="fas fa-pencil-alt text-inverse mr-2"></i> Edit
                                                        </a>
                                                        <form action="{{ route('file.destroy', $item->id)}}" style="margin-left : 18px;float:left;"  method="post" data-toggle="tooltip" data-original-title="Delete">
                                                            {{ csrf_field() }}
                                                            @method('DELETE')    
                                                            <button style="border:0px;" class="fas fa-window-close text-danger" type="submit"> Delete</button> 
                                                        </form>
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