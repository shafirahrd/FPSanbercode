@extends('adminlte.master')

@push('styles')
span {
  font-size: small;
}
span.float-right{
  float: right;
}
span.margin-right{
  margin-right: 25px;
}
a {
  margin-left:auto;
}
h4 {
  color: #008b8b;
}
.btn.col-12{
  background-color: #008b8b;
}
.fa{
  color: #FFAE42;
}
.btn-warning{
  size
}
@endpush

@section('content')
<div class="card-header d-flex justify-content-between">
  <h3 class="card-title">Questions</h3>
  <a href="/question/create"><button  class="btn btn-primary col-12">Add Question</button></a>
</div>
<!-- /.card-header -->
<div class="card-body">
  @foreach ($questions as $question)
    <div class="card card-outline card-warning" id="question-id">
      <div class="card-header">
        <a href="/question/{{$question->id}}"><h4>{{$question->title}}</h4></a>
        <a href="/user/{{$question->uploader->id}}"><h6>{{$question->uploader->name}}</h6></a>

        @foreach (explode(",",$question->tags) as $tag)
          <a href="#" class="btn btn-xs btn-warning">{{$tag}}</a>
        @endforeach
      </div>
      <div class="card-body">
        {{$question->content}}
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <span class="margin-right"><i class="fa fa-thumbs-up" aria-hidden="true"></i></span>
        <span class="margin-right"><i class="fa fa-thumbs-down" aria-hidden="true"></i></span>
        <span class="margin-right">{{App\Question::count_votes($question->id)}}</span>
        <span class="float-right">Created at {{$question->created_at}}</span>
      </div>
      <!-- /.card-footer-->
    </div>
  @endforeach

</div>
@endsection

@push('scripts')

@endpush