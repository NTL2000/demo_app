@extends('layouts.app')
  {{-- {{ session('status') }} --}}
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- @if($Entries)
            {{print_r($Entries[0]['User']->name);}}
            @endif --}}
            @auth
                <button class="btn_createPost" data-toggle="modal" data-target="#exampleModal">Create new post</button>
            @endauth
            @foreach ($Entries as $entry)
            <div class="card">
                <div class="card-header name_user"><a href="{{asset('user/'.$entry['User']->id)}}">{{ __($entry['User']->name) }}</a></div>

                <div class="card-body">
                    <div class="body-content">
                        <h3>{{ __("#".$entry->title) }}</h3>
                        <span>{{ __($entry->body) }}</span>
                    </div>
                    <div class="image">
                        <img src="{{asset('uploads/'.$entry->image_name)}}" alt="">
                    </div>
                </div>
                <div class="card-footer">
                    <div class="list_comment">
                        <ul class="list_comment_wraper">
                            @foreach ($entry['Comment'] as $comment)
                                <li>
                                    <h5><a href="{{asset('user/'.$comment['User']->id)}}">{{ __("#".$comment['User']->name) }}</a></h5>
                                    <p>{{ __($comment->body) }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @auth
                        <div class="comment">
                            <form method="POST" action="{{ route('comment.store')  }}" class="comment_form">
                                @csrf
                                <input name="message" placeholder="enter your comment" type="text" required>
                                <input type="hidden" name="user" value="{{Auth::user()->name}}">
                                <input type="hidden" name="entry_id" class="entry_id" value="{{$entry->id}}">
                                <input type="submit" class="btn_comment" value="enter">
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
            @endforeach
            {{ $Entries->links() }}
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
