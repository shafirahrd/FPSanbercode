@extends('adminlte.master')

@section('content')

    <div class="container-fluid d-flex justify-content-center flex-column" >
        <h2 style="text-align: center; margin: 30px">Upload your question here</h2>
        <form action="/question" method="POST" class="col-10 align-self-center">
            @csrf
            <div class="form-group row ">
                <div class="col-12">
                    <input type="text" class="form-control" name="title" id="title" placeholder="Enter your question title here" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <textarea style="height: 300px" type="text" class="form-control" name="content" id="content" placeholder="Enter your question content here" required></textarea>
                </div>
            </div>
            <div class="form-group row ">
                <div class="col-12">
                    <input type="text" class="form-control" name="tags" id="tags" placeholder="Enter your question tags here">
                    <p style="font-size: small; color: silver;">*if more than one, separate by comma (,)</p>
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