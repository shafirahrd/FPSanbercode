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
<!--            @if (Session::has('id') && (Session::get('id')==$user->id))
            <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="/user/{{$user->id}}" method="POST">
                      @csrf
                      @method('put')
                      <div class="mb-3">
                        <textarea name="content" class="textarea" placeholder="Type your answer comment here"></textarea>
                      </div>
                      <div class="offset-2 col-8">
                        <button  class="btn btn-warning col-12 margin-custom">Add Comment</button>
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
              <a href="#" data-toggle="modal" data-target="#staticBackdrop">
                <i class="fas fa-edit" style="color: black; float: right; margin-top: -30px;" aria-hidden="true"> Edit</i>
              </a>
            @endif
            -->
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