@extends('layouts.app')
  {{-- {{ session('status') }} --}}
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @auth
                <button class="btn_createPost" data-toggle="modal" data-target="#exampleModal">Create new post</button>
            @endauth
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div class="body-content">
                        <span></span>
                    </div>
                    <div class="image">
                        <img src="" alt="">
                    </div>
                </div>
                <div class="card-footer">
                    footer
                </div>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div class="body-content">
                        <span></span>
                    </div>
                    <div class="image">
                        <img src="" alt="">
                    </div>
                </div>
                <div class="card-footer">
                    footer
                </div>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div class="body-content">
                        <span></span>
                    </div>
                    <div class="image">
                        <img src="" alt="">
                    </div>
                </div>
                <div class="card-footer">
                    footer
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form method="POST" enctype="multipart/form-data" action="{{ route('entry.store')  }}">
            @csrf
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New status</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label required-input">Title(<span>*</span>):</label>
                    <input type="text" class="form-control" name="title" id="recipient-name" required>
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label required-input">Body(<span>*</span>):</label>
                    <textarea class="form-control" name="body" id="message-text" required></textarea>
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Image:</label>
                    <input type="file" name="image_name" class="form-control" id="name" value="">
                    @if($errors->has('image_name'))
                        <span class="help-block">{{ $errors->first('image_name') }}</span>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Post</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection
