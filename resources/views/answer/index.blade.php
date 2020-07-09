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
@endpush

@section('content')
<div class="card-header">
    <h2>Title</h2>
    <h4><pre>Content</pre></h4>
    <div class="card-footer d-flex justify-content-between">
      <span class="medium">anonymous</span>
      <span class="medium auto">
        created: , last updated: 
      </span>  
    </div>
    <div class="container d-flex justify-content-around">
      <a class="col-3" href="/question/id/edit">
        <button class="btn btn-warning col-6 margin-zero">Edit</button>
      </a>
      <form class="col-3" action="/question/id/delete" method="post">
        @method('delete')
        @csrf
        <input class="btn btn-danger col-6" type="submit" value="Delete" />
      </form>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <div class="card">
        <div class="card-body">
          <pre>Jawaban content</pre>
        </div>
        <!-- /.card-body -->
        <div class="card-footer d-flex justify-content-between">
          <span class="small name">by anonymus</span>
          <span class="margin-right icon"><i class="fa fa-thumbs-up" aria-hidden="true"> 1</i></span>
          <span class="margin-right icon"><i class="fa fa-thumbs-down" aria-hidden="true"> 6</i></span>
          <span class="small auto">
            created: , last updated: 
          </span>
        </div>
        <!-- /.card-footer-->
    </div>
      
      <div class="card card-outline card-warning">
        <div class="card-header">
          <h3 class="card-title">
            Upload your answer here
          </h3>
        </div>
        <div class="card-body pad">
          <form action="/answer/id" method="POST">
            @csrf
            <div class="mb-3">
              <textarea name="content" class="textarea" placeholder="Type your answer here"></textarea>
            </div>
            <div class="offset-2 col-8">
              <button  class="btn btn-info col-12 margin-custom">Add Answer</button>
            </div>
          </form>
        </div>
      </div>
  </div>
@endsection