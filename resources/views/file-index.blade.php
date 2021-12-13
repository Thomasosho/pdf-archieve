@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md">
                    <h3>Recent Uploads
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Launch demo modal
                        </button>
                    </h3>
                    <table class="table text-center">
                        <thead>
                            <th>#Id</th>
                            <th>Name</th>
                            <th>File Type</th>
                            <th>Date</th>
                        </thead>
                        <tbody>
                            @if($sort->count())
                                @foreach($sort as $date => $s )
                                    <tr>
                                        {{$date}}
                                        <td>{{ ++$date }}</td>
                                        <td>{{$s->orig_filename}}</td>
                                        <td>{{$s->extension}}</td>
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