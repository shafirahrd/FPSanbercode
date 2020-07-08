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
@endpush

@section('content')
<div class="card-header d-flex justify-content-between">
  <h3 class="card-title">Questions</h3>
  <a href="/question/create"><button  class="btn btn-primary col-12">Add Question</button></a>
</div>
<!-- /.card-header -->
<div class="card-body">
      <div class="card" id="question-id">
          <div class="card-header">
            <a class="card-title" href="/answer"><h4>Title</h4></a>
          </div>
          <div class="card-body">
              Content
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <span class="margin-right"><i class="fa fa-thumbs-up" aria-hidden="true"></i></span>
            <span class="margin-right"><i class="fa fa-thumbs-down" aria-hidden="true"></i></span>
            <span class="float-right">Created at</span>
          </div>
          <!-- /.card-footer-->
      </div>
</div>
@endsection

@push('scripts')

@endpush