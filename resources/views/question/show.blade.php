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
span.comment-span.hide{
  display: none;
}
span.comment-span.comment{
  margin-bottom: 50px;
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
div.card-header.answer,
div.card-header.comment-content{
  border: none;
}
a.comment-add-button{
  position: absolute;
  right:50px;
  top: 250px;
  font-weight: bold;
  color: #008b8b;
}
.comment-span{
  display:block;
  margin: 10px 20px 0;
  cursor: pointer;
}
.comment-span:hover{
  color: blue;
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
    @if (Session::has('id'))
      <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Comment</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="/question/comment/{{$question->id}}" method="POST">
                @csrf
                <div class="mb-3">
                  <textarea name="content" class="textarea" placeholder="Type your comment here"></textarea>
                </div>
                <div class="offset-2 col-8">
                  <button  class="btn btn-primary col-12 margin-custom">Add Comment</button>
                </div>
              </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <a href="#" class="comment-add-button" data-toggle="modal" data-target="#staticBackdrop">Add Comment</a>
    @endif
    @if (count($question->comments)>0)
    <span class="comment-span comment" style="margin-top: 10px;">show comments({{count($question->comments)}})</span>
    <span class="comment-span hide">hide comments</span>
    <div class="card-header comment-content">
      <div class="card">
        <div class="card-body">
      @foreach ($question->comments as $comments)
          <p>{{$comments->content}} - <a href="/user/{{$comments->uploader->id}}"> {{$comments->uploader->name}}</a>
          <span class="small auto">{{$comments->created_at}}</span></p><hr>
      @endforeach
        </div>
      </div>
    </div>
    @endif

</div>
  <!-- /.card-header -->
  <div class="card-header answer">
    <h3>Answers</h3>
  </div>
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
            @if (Session::has('id'))
                <button class="btn btn-primary col-3 float-right" type="button" data-toggle="modal" data-target="#staticBackdropAns">
                  Add Comment
                </button>
                <div class="modal fade" id="staticBackdropAns" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Comment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="/answer/comment/{{$answer->id}}" method="POST">
                          @csrf
                          <div class="mb-3">
                            <textarea name="content" class="textarea" placeholder="Type your answer comment here"></textarea>
                          </div>
                          <div class="offset-2 col-8">
                            <button  class="btn btn-primary col-12 margin-custom">Add Comment</button>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
              @endif
              @if (count($answer->comments)>0)
              <span class="comment-span">show comments({{count($answer->comments)}})</span>
              <span class="comment-span hide">hide comments</span>
              <div class="card-header comment-content">
                @foreach ($answer->comments as $comments)
                <div class="card">
                    <div class="card-body">
                      <p>{{$comments->content}} -<a href="/user/{{$comments->uploader->id}}">{{$comments->uploader->name}}</a></p>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                      <span class="small auto">
                        {{$comments->created_at}}
                      </span>
                    </div>
                </div>
                @endforeach
              </div>
              @endif
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

@push('scripts')
    <script src="{{asset('\comment.js')}}"></script>
@endpush