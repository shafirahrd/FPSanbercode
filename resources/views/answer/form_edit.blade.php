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
        <h2 class="text-center">Edit your answer here</h2>
        <form action="/answer/{{$answer->id}}" method="POST" class="col-6  align-self-center">
            @csrf
            <div class="form-group row">
                <div class="col-12">
                    <textarea style="height: 300px" type="text" class="form-control" name="content" id="content" placeholder="Enter your question content here" required></textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-2 col-8">
                    <button type="submit" class="btn btn-primary col-12">Save</button>
                </div>
            </div>
            @method('put')
        </form>
    </div>
@endsection

@push('scripts')
    @php
        $content = json_encode($answer->content);

    @endphp
    <script>
        var content = "{{$content}}";
        $('textarea#content').val(content.replace(/(&quot\;)/g,""));
    </script>
@endpush