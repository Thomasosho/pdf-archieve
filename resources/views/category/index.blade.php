@extends('layouts.app')

@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-8 p-5">
                <h2>New Category</h2>
                <p>Add Category</p>
            </div>
            <div class="col-md-7 px-5">
                <form action="/category/store" enctype="multipart/form-data" method="POST">
                    {{ csrf_field() }} @csrf
                    <div class="row g-3 py-2">
                        <div class="col-sm">
                            <input type="text" class="form-control" name="class" placeholder="Class" aria-label="Class">
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
                        @if($category->count())
                            @foreach($category as $key => $s)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{$s->name}}</td>
                                    <td>{{$s->created_at}}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">There are no data.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {{ $category->links() }}
            </div>
        </div>
    </div>
</section>
@endsection