@extends('layouts.app')

@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-8 p-5">
                <h2>New Unit</h2>
                <p>Add Unit</p>
            </div>
            <div class="col-md-7 px-5">
                <form action="/unit" enctype="multipart/form-data" method="POST">
                    {{ csrf_field() }}
                    <div class="row g-3 py-2">
                        <div class="col-sm">
                            <input type="text" class="form-control" name="name" placeholder="Unit Name" aria-label="Unit Name">
                        </div>
                    </div>
                    <button class="form-control" type="submit">create</button>
                </form>
            </div>
            <div class="col-md-5">
                <table class="table text-center">
                    <thead>
                        <th>#Id</th>
                        <th>Name</th>
                        <th>Date Created</th>
                    </thead>
                    <tbody>
                        @if($unit->count())
                            @foreach($unit as $key => $s)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{$s->name}}</td>
                                    <td>{{$s->created_at->diffForHumans()}}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">There are no data.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {{ $unit->links() }}
            </div>
        </div>
    </div>
</section>
@endsection