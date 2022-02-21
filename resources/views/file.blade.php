@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 px-5 py-3">
                    <h2>Add new documents</h2>
                    <p>Upload multiple documents</p>
                </div>
                <div class="col-md-12 px-5">
                    <form action="/save" enctype="multipart/form-data" method="POST">
                        {{ csrf_field() }}
                        <div class="input-group mb-3">
                            <select name="category_id" class="form-control" searchable="Search here..">
                                <option value="" disabled selected>Select File Volume</option>
                                @foreach($category as $c)
                                    <option value="{{$c->id}}">&#xf07c; {{$c->name}} @if($c->pin != null) &#xf023; @endif</option>
                                @endforeach
                            </select>
                            <button class="input-group-text" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fas fa-folder-plus px-2"></i> 
                                Create File Volume
                            </button>
                        </div>
                        <div class="input-group mb-3">
                            <select name="unit_id" class="form-control" searchable="Search here...">
                                <option value="" disabled selected>Unit Name/Formation</option>
                                @foreach($unit as $u)
                                    <option value="{{$u->id}}">&#xf07c; {{$u->name}}</option>
                                @endforeach
                            </select>
                            <button class="input-group-text" type="button" data-bs-toggle="modal" data-bs-target="#unitModal">
                                <i class="fas fa-folder-plus px-2"></i> 
                                Create Unit/Formation
                            </button>
                        </div>
                        <div class="row g-3 py-2">
                            <div class="col-sm">
                                <label for="unit name/formation">File Reference e.g NA/220/40/G(TRG)</label>
                                <input type="text" class="form-control" name="reference" placeholder="NA/220/40/G(TRG)" aria-label="reference">
                            </div>
                        </div>
                        <div class="row g-3 py-2">
                            <div class="col-sm">
                                <input type="text" id="datepicker" placeholder="dd-mm-yyyy" class="form-control" name="opendate" placeholder="Open Date" aria-label="Open Date">
                            </div>
                            <div class="col-sm">
                                <input type="text" id="datepickers" placeholder="dd-mm-yyyy" class="form-control" name="closedate" placeholder="Close Date" aria-label="Close Date">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="file" name="files[]" multiple accept=".docx,.pdf" class="form-control">
                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
                        </div>
                        <button style="background-color:#4b5320 !important; color: #ffffff !important;" class="form-control" type="submit">submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        $(function () {
            $('#datepicker').datepicker({ dateFormat: 'dd-mm-yy' });
        });
    </script>

<script type="text/javascript">
        $(function () {
            $('#datepickers').datepicker({ dateFormat: 'dd-mm-yy' });
        });
    </script>
    
@endsection