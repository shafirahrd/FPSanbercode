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
            <h4>Welcome, {{$user->name}}!</h4>
            <a href="/user/{{$user->id}}">
              <i class="fas fa-edit" style="color: black; float: right; margin-top: -30px;" aria-hidden="true"> Edit</i>
            </a>
          </div>
          <div class="card-body">
              <p>Email: {{$user->email}}</p>
              <p>Password: ******</p>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <a href="#" class="btn btn-xs btn-danger">Reputation: {{$user->reputation}}</a>
            <a href="#" class="btn btn-xs btn-success">Questions asked: {{count($user->questions)}}</a>
            <a href="#" class="btn btn-xs btn-primary">Answers : {{count($user->answers)}}</a>
            <span class="float-right">Member since: {{$user->created_at}}</span>
          </div>
          <!-- /.card-footer-->
      </div>
</div>
@endsection

@push('scripts')

@endpush