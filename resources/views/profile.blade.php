@extends('layouts.profile_layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- @if($Entries)
            {{print_r($Entries[0]['User']->name);}}
            @endif --}}
            <div class="container mt-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-7">
                        <div class="card p-3 py-4">
                            <div class="text-center"> <img src="https://i.imgur.com/bDLhJiP.jpg" width="100" class="rounded-circle"> </div>
                
                            <div class="text-center mt-3"> 
                                @auth
                                @if($user[0]->id != Auth::id())
                                <span class="bg-secondary p-1 px-4 rounded text-white follow_status">
                                    @if($check_follow==1)
                                    Following
                                    @else
                                    UnFollowed
                                    @endif
                                </span>
                                @endif
                                @endauth
                                <h5 class="mt-2 mb-0">{{$user[0]->name}}</h5> <span>{{$user[0]->email}}</span>
                                <ul class="social-list">
                                    <li><i class="fa fa-facebook"></i></li>
                                    <li><i class="fa fa-dribbble"></i></li>
                                    <li><i class="fa fa-instagram"></i></li>
                                    <li><i class="fa fa-linkedin"></i></li>
                                    <li><i class="fa fa-google"></i></li>
                                </ul>
                                @auth
                                @if($user[0]->id != Auth::id())
                                <input type="hidden" value="{{$user[0]->id}}">
                                <div class="buttons follow_button"> 
                                    @if($check_follow==1)
                                    <button class="btn btn-primary px-4 ms-3" id="btn_unfollow">UnFollow</button> 
                                    @else
                                    <button class="btn btn-primary px-4 ms-3" id="btn_follow">Follow</button> 
                                    @endif
                                </div>
                                @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection