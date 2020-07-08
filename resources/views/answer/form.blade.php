@extends('adminlte.master')

@section('content')

    <div class="container-fluid d-flex justify-content-center flex-column" >
        <h2 style="text-align: center; margin: 30px">Upload your answer here</h2>
        <form action="/answer/" method="POST" class="col-6  align-self-center">
            @csrf
            <div class="form-group row">
                <div class="col-12">
                    <textarea style="height: 300px" type="text" class="form-control" name="content" id="content" placeholder="Enter your answer here" required></textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-2 col-8">
                    <button type="submit" class="btn btn-primary col-12">Upload</button>
                </div>
            </div>
        </form>
    </div>
@endsection