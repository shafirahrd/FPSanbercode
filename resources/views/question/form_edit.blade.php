@extends('adminlte.master')

@push('styles')
h2 {
    text-align: center;
    margin: 30px;
}
textarea.h300{
    height: 300px;
}
@endpush

@section('content')

    <div class="container-fluid d-flex justify-content-center flex-column" >
        <h2>Upload your question here</h2>
        <form action="/question/update" method="POST" class="col-6  align-self-center">
            @csrf
            <div class="form-group row ">
                <div class="col-12">
                    <input type="text" class="form-control" name="title" id="title" placeholder="Enter your question title here" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <textarea type="text" class="form-control h300" name="content" id="content" placeholder="Enter your question content here" required></textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-2 col-8">
                    <button type="submit" class="btn btn-primary col-12">Upload</button>
                </div>
            </div>
            @method('put')
        </form>
    </div>
@endsection

@push('scripts')

@endpush