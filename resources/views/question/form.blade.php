@extends('adminlte.master')

@push('styles')
@endpush

@section('content')

    <div class="container-fluid d-flex justify-content-center flex-column" >
        <h2 class="text-center" style="margin-top:30px; margin-bottom:15px; font-weight: bold; color: #003e3f;">Upload your question here</h2>
        <form action="/question" method="POST" class="col-10 align-self-center">
            @csrf
            <div class="form-group row ">
                <div class="col-12">
                    <input type="text" class="form-control" name="title" id="title" placeholder="Enter your question title here" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <textarea rows="10" cols="50" style="height: 300px" type="text" class="form-control" name="content" id="content-ta" placeholder="Enter your question content here" required></textarea>
                </div>
            </div>
            <div class="form-group row ">
                <div class="col-12">
                    <input type="text" class="form-control" name="tags" id="tags" placeholder="Enter your question tags here" required>
                    <p style="font-size: small; color: silver;">*if more than one, separate by comma (,)</p>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-2 col-8">
                    <button type="submit" class="btn btn-warning col-12" style="color: #008b8b; font-weight: bold;">ASK</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script src="{{asset('ckeditor/ckeditor/ckeditor.js')}}"></script>
<script>
  CKEDITOR.replace( 'content-ta' );
  CKEDITOR.config.allowedContent = true;
</script>
@endpush