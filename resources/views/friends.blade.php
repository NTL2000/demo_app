@extends('layouts.friends')
  {{-- {{ session('status') }} --}}
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div id="content" class="content p-0">
            {{-- <div class="profile-header">
                <ul class="profile-header-tab nav nav-tabs">
                    <li class="nav-item"><a href="#profile-friends" class="nav-link active show" data-toggle="tab">FRIENDS</a></li>
                    <li class="nav-item"><a href="#profile-other-users" class="nav-link" data-toggle="tab">Other users</a></li>
                </ul>
            </div> --}}

            <div class="profile-container">
                <div class="row row-space-20 justify-content-center">
                    <div class="col-md-8">
                        <div class="tab-content p-0">

                            <div class="tab-pane fade active show" id="profile-friends">
                                <div class="m-b-10"><b>Following ({{count($followingUser)}})</b></div>

                                <ul class="friend-list clearfix">
                                    @foreach ($followingUser as $user)
                                    <li>
                                        <a href="{{asset('user/'.$user->id)}}">
                                            <div class="friend-img"><img src="https://i.imgur.com/bDLhJiP.jpg" alt="" /></div>
                                            <div class="friend-info">
                                                <h4>{{$user->name}}</h4>
                                                <p>{{$user->email}}</p>
                                            </div>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content p-1">

                            <div class="tab-pane fade active show" id="profile-other-users">
                                <div class="m-b-10"><b>Follower user ({{count($followerUser)}})</b></div>

                                <ul class="friend-list clearfix">
                                    @foreach ($followerUser as $user)
                                    <li>
                                        <a href="{{asset('user/'.$user->id)}}">
                                            <div class="friend-img"><img src="https://i.imgur.com/bDLhJiP.jpg" alt="" /></div>
                                            <div class="friend-info">
                                                <h4>{{$user->name}}</h4>
                                                <p>{{$user->email}}</p>
                                            </div>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content p-2">

                            <div class="tab-pane fade active show" id="profile-other-users">
                                <div class="m-b-10"><b>Other user ({{count($notFollowUser)}})</b></div>

                                <ul class="friend-list clearfix">
                                    @foreach ($notFollowUser as $user)
                                    <li>
                                        <a href="{{asset('user/'.$user->id)}}">
                                            <div class="friend-img"><img src="https://i.imgur.com/bDLhJiP.jpg" alt="" /></div>
                                            <div class="friend-info">
                                                <h4>{{$user->name}}</h4>
                                                <p>{{$user->email}}</p>
                                            </div>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
