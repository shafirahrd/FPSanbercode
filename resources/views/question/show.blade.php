@extends('adminlte.master')

@push('styles')
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
span.name{
  margin-right: 15px;
}
span.name, span.icon{
  margin-left: 15px;
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
.comment-span{
  margin: 0 20px;
  cursor: pointer;
  vertical-align: -webkit-baseline-middle;
}
.comment-span:hover{
  color: blue;
}
.comment-content{
  margin-top: 20px;
}
@endpush

@section('content')
<div class="card-header">
    <h2>{{$question->title}}</h2>
    <p style="white-space: pre-wrap;">{{$question->content}}</p>
    @foreach (explode(",",$question->tags) as $tag)
      <a href="#" class="btn btn-xs btn-warning">{{$tag}}</a>
    @endforeach
    <div class="card-footer d-flex justify-content-between mt-2">
      <span class="margin-right icon"><i class="fa fa-thumbs-up" aria-hidden="true"></i></span>
      <span class="margin-right icon"><i class="fa fa-thumbs-down" aria-hidden="true"></i></span>
      <span class="margin-right" style="margin: 0 10px;">{{App\Question::count_votes($question->id)}}</span>
      <span class="medium name">by <a href="/user/{{$question->uploader->id}}">{{$question->uploader->name}}</a></span>
      <span class="medium auto">
        created: {{$question->created_at}}, last updated: {{$question->updated_at}}
      </span>  
    </div>
    @if (Session::has('id')  && (Session::get('id')==$question->uploader->id))
      <div class="container d-flex justify-content-around">
        <a class="col-3" href="/question/{{$question->id}}/edit">
          <button class="btn btn-warning col-6 margin-zero">Edit</button>
        </a>
        <form class="col-3" action="/question/{{$question->id}}" method="post">
          @method('delete')
          @csrf
          <input class="btn btn-danger col-6" type="submit" value="Delete" />
        </form>
      </div>
    @endif
    @if (Session::has('id'))
      <button class="btn btn-primary col-2 float-right" type="button" data-toggle="modal" data-target="#staticBackdrop">
        Add Comment
      </button>
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
    @endif
    @if (count($question->comments)>0)
    <span class="comment-span">show comments({{count($question->comments)}})</span>
    <span class="comment-span" style="display: none;">hide comments</span>
    <div class="card-header comment-content">
      @foreach ($question->comments as $comments)
      <div class="card">
          <div class="card-body">
            <p style="white-space: pre-wrap;">{{$comments->content}} -<a href="/user/{{$comments->uploader->id}}">{{$comments->uploader->name}}</a></p>
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

  <div class="card-header">
    <h2>Answer</h2>
    <div class="card-body">
      @foreach ($question->answers as $answer)
          <div class="card">
            <div class="card-header">
              <div class="card-body">
              <p style="white-space: pre-wrap;">{{$answer->content}}</p>
              @if(Session::has('id') && (Session::get('id')==$answer->uploader->id))
              <div class="container d-flex justify-content-around">
                  <a class="col-3" href="/answer/{{$answer->id}}/edit">
                  <button class="btn btn-warning col-6 margin-zero">Edit</button>
                  </a>
                  <form class="col-3" action="/answer/{{$answer->id}}" method="post">
                  @method('delete')
                  @csrf
                  <input class="btn btn-danger col-6" type="submit" value="Delete" />
                  </form>
              </div>
              @endif
              </div>
              <!-- /.card-body -->
              <div class="card-footer d-flex justify-content-between">
              <span class="margin-right icon"><i class="fa fa-thumbs-up" aria-hidden="true"></i></span>
              <span class="margin-right icon"><i class="fa fa-thumbs-down" aria-hidden="true"></i></span>
              <span class="margin-right" style="margin: 0 10px;">{{App\Answer::count_votes($answer->id)}}</span>
              <span class="small name">by <a href="/user/{{$answer->uploader->id}}">{{$answer->uploader->name}}</a></span>
              <span class="small auto">
                  created: {{$answer->created_at}}, last updated: {{$answer->updated_at}}
              </span>
              </div>
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
              <span class="comment-span" style="display: none;">hide comments</span>
              <div class="card-header comment-content">
                @foreach ($answer->comments as $comments)
                <div class="card">
                    <div class="card-body">
                      <p style="white-space: pre-wrap;">{{$comments->content}} -<a href="/user/{{$comments->uploader->id}}">{{$comments->uploader->name}}</a></p>
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
                  <button  class="btn btn-info col-12 margin-custom">Add Answer</button>
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
  </div>
@endsection

@push('scripts')
  <script src="{{asset('\comment.js')}}"></script>
@endpush