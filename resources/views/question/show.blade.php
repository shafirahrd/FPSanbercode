@extends('adminlte.master')

@push('styles')
p {
  white-space: pre-wrap;
}
pre {
  font-family: "Source Sans Pro","Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif !important;
}
span.small {
  font-size: small;
}
span.medium {
  font-size: medium;
}
span.auto {
  margin-left: auto;
}
span.medium.auto, span.small.auto {
  float:right;
}
span.name{
  margin-right: 15px;
}
span.name, span.icon{
  margin-left: 15px;
}
span.margin-right{
  margin-right: 25px;
}
button.margin-zero {
  margin: 0;
}
button.margin-custom {
  margin: 30px 0 10px;
}
textarea {
  width: 100%;
  height: 200px;
  font-size: 14px;
  line-height: 18px;
  border: 1px solid rgb(221, 221, 221);
  padding: 10px;
}
.justify-content-around {
  margin-top: 15px;
}
span.margin-right-custom {
  margin: 0 10px;
}
a.btn.btn-xs.btn-warning {
  margin-bottom: 10px;
}
div.container.answer{
  float: right;
}
div.question, div.answer-button{
  float: right;
}
hr{
  margin-top: 20px;
}
form.col-3{
  display: inline-block;
}
input.btn.btn-danger.col-6{
  padding-right:54px;
}
div.card-body.answer {
  margin-right: 30px;
  margin-left: 30px;
}
@endpush

@section('content')
<div class="card-header">
    <h2>{{$question->title}}</h2>
    <p>{{$question->content}}</p>
    @foreach (explode(",",$question->tags) as $tag)
      <a href="#" class="btn btn-xs btn-warning">{{$tag}}</a>
    @endforeach
    <div class="card-footer">
      @if (Session::has('id')  && (Session::get('id')==$question->uploader->id))
        <div class="question">
          <a class="col-3" href="/question/{{$question->id}}/edit">
            <button class="btn btn-success col-6 margin-zero">Edit</button>
          </a>
          <form class="col-3" action="/question/{{$question->id}}" method="post">
            @method('delete')
            @csrf
            <input class="btn btn-danger col-6" type="submit" value="Delete" />
          </form>
        </div>
      @endif
      by <a href="/user/{{$question->uploader->id}}">  {{$question->uploader->name}}</a><hr>
      <span class="margin-right icon"><i class="fa fa-thumbs-up" aria-hidden="true"></i></span>
      <span class="margin-right icon"><i class="fa fa-thumbs-down" aria-hidden="true"></i></span>
      <span class="margin-right custom"><i class="fa fa-vote-yea" aria-hidden="true"> {{App\Question::count_votes($question->id)}}</i></span>
      <span class="medium auto">
        created: {{$question->created_at}}, last updated: {{$question->updated_at}}
      </span>  
    </div>
    
</div>
  <!-- /.card-header -->
  <div class="card-body answer">
    @foreach ($question->answers as $answer)
        <div class="card">
            <div class="card-body">
            <p>{{$answer->content}}</p>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            @if(Session::has('id') && (Session::get('id')==$answer->uploader->id))
            <div class="answer-button">
                <a class="col-3" href="/answer/{{$answer->id}}/edit">
                <button class="btn btn-success col-6 margin-zero">Edit</button>
                </a>
                <form class="col-3" action="/answer/{{$answer->id}}" method="post">
                @method('delete')
                @csrf
                <input class="btn btn-danger col-6" type="submit" value="Delete" />
                </form>
            </div>
            @endif
            by <a href="/user/{{$answer->uploader->id}}"> {{$answer->uploader->name}}</a><hr>
            <span class="margin-right icon"><i class="fa fa-thumbs-up" aria-hidden="true"></i></span>
            <span class="margin-right icon"><i class="fa fa-thumbs-down" aria-hidden="true"></i></span>
            <span class="margin-right custom"><i class="fa fa-vote-yea" aria-hidden="true"> {{App\Answer::count_votes($answer->id)}}</i></span>
            <span class="small auto">
                created: {{$answer->created_at}}, last updated: {{$answer->updated_at}}
            </span>
            </div>
            <!-- /.card-footer-->
        </div>
    @endforeach     
      <div class="card card-outline card-warning">
        @if (Session::has('name'))
          <div class="card-header">
            <h3 class="card-title">
              Upload your answer here
            </h3>
          </div>
          <div class="card-body pad">
            <form action="/answer/{{$question->id}}" method="POST">
              @csrf
              <div class="mb-3">
                <textarea name="content" class="textarea" placeholder="Type your answer here"></textarea>
              </div>
              <div class="offset-2 col-8">
                <button  class="btn btn-warning col-12 margin-custom" style="color: #008b8b; font-weight: bold;">Add Answer</button>
              </div>
            </form>
          </div>
        @else
        <div class="card-body pad">
            <p class="text-center">Log in to answer</p>
              <div class="offset-2 col-8">
                <a href="/login" class="btn btn-info col-12 margin-custom">Log in</a>
              </div>
        @endif
      </div>
  </div>
@endsection