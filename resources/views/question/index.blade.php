@extends('adminlte.master')

@push('styles')
span {
  font-size: small;
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
          <div class="card-footer d-flex justify-content-end">
            <span>Created at</span>
          </div>
          <!-- /.card-footer-->
      </div>
</div>
@endsection

@push('scripts')

@endpush