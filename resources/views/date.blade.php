@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8 py-3 px-5">
                    <h2>Sample Demonstration</h2>
                    <p>Sort by date</p>
                </div>
                <div class="col-md-8 px-5">
                    <h4>Archive</h4>
                    <ul>
                        @foreach($sort as $date => $items )
                        <li>
                            <p style="font-weight:bold; font-style:itallic;">{{$date}} </p>
                            <ul>
                                @foreach ($items as $item) 
                                    <li>
                                        {{$item->orig_filename}} <em style="font-weight:bold;">{{$item->date}}</em>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection