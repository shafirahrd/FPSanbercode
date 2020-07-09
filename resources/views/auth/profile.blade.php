@extends('adminlte.master')

@push('styles')

@endpush

@section('content')
<center>
  <img src="{{ asset('adminlte/dist/img/avatar.png') }}" style="margin-top: 20px;" />
</center>
<!-- /.card-header -->
<div class="card-body">
      <div class="card card-outline card-warning" id="question-id">
          <div class="card-header">
            <h4>Welcome, {{Session::get('name')}}!</h4>
            <a href="/user/{{Session::get('id')}}">
              <i class="fas fa-edit" style="color: black; float: right; margin-top: -30px;" aria-hidden="true"> Edit</i>
            </a>
          </div>
          <div class="card-body">
              <p>Email: </p>
              <p>Password: ******</p>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <a href="#" class="btn btn-xs btn-danger">Reputation: 124</a>
            <a href="#" class="btn btn-xs btn-success">Questions asked: 52</a>
            <a href="#" class="btn btn-xs btn-primary">Answers : 1234</a>
            <span class="float-right">Member since: </span>
          </div>
          <!-- /.card-footer-->
      </div>
</div>
@endsection

@push('scripts')

@endpush