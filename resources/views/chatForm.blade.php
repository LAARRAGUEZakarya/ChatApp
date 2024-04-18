@extends('layouts.app')
@section('conetent')

<div class="container-fluid h-100">
    <form style="float: right;" method="POST" action="{{route('logout')}}">
        @csrf
        <button class="btn btn-secondery mt-2"><i class="fa-solid fa-right-from-bracket"></i></button>
    </form>
    <div class="row justify-content-center h-100">

        <div class="col-md-4 col-xl-3 chat"><div class="card mb-sm-3 mb-md-0 contacts_card">
            <div class="card-header">
                <div class="input-group">
                    <input type="text" placeholder="Search..." name="" class="form-control search">
                    <div class="input-group-prepend">
                        <span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
                    </div>
                </div>
            </div>
            <div class="card-body contacts_body">
                <ui class="contacts">
                    @foreach ($users as $user )
                        @if ($user->id == $receiver->id)
                            <li class="active">
                                <a href="{{route('chatForm',$user->id)}}" class="d-flex bd-highlight" style="text-decoration: none;">
                                    <div class="img_cont">
                                        <img src="{{asset($receiver->image)}}" class="rounded-circle user_img">
                                        <span class="online_icon"></span>
                                    </div>
                                    <div class="user_info">
                                        <span>{{$receiver->name}}</span>
                                        <p>{{$receiver->name}} is online</p>
                                    </div>
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{route('chatForm',$user->id)}}" class="d-flex bd-highlight" style="text-decoration: none;">
                                    <div class="img_cont">
                                        <img src="{{asset($user->image)}}" class="rounded-circle user_img">
                                        <span class="online_icon"></span>
                                    </div>
                                    <div class="user_info">
                                        <span>{{$user->name}}</span>
                                        <p>{{$user->name}} is online</p>
                                    </div>
                                </a>
                            </li>
                        @endif

                    @endforeach


                </ui>
            </div>
            <div class="card-footer"></div>
        </div></div>

        <div class="col-md-8 col-xl-6 chat">
            <div class="card">
                <div class="card-header msg_head">
                    <div class="d-flex bd-highlight">
                        <div class="img_cont">
                            <img src="{{asset($receiver->image)}}" class="rounded-circle user_img">
                            <span class="online_icon"></span>
                        </div>
                        <div class="user_info">
                            <span>Chat with {{$receiver->name}}</span>
                            <p>{{$messages->count()}} Messages</p>
                        </div>
                        <div class="video_cam">
                            <span><i class="fas fa-video"></i></span>
                            <span><i class="fas fa-phone"></i></span>
                        </div>
                    </div>
                    <span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
                    <div class="action_menu">
                        <ul>
                            <li><i class="fas fa-user-circle"></i> View profile</li>
                            <li><i class="fas fa-users"></i> Add to close friends</li>
                            <li><i class="fas fa-plus"></i> Add to group</li>
                            <li><i class="fas fa-ban"></i> Block</li>
                        </ul>
                    </div>
                </div>
                <div class="card-body msg_card_body " id="chat_area">
                    @foreach ($messages as $message)
                    @php
                        $messageDate = \Carbon\Carbon::parse($message->created_at);
                        $formattedTime = $messageDate->isToday() ? $messageDate->format('g:i A, ').'Today' : $messageDate->format('g:i A, l');

                    @endphp

                        @if ($message->receiver_id!=$receiver->id)
                            <div class="d-flex justify-content-start mb-4" >
                                <div class="img_cont_msg">
                                    <img src="{{asset($receiver->image)}}" class="rounded-circle user_img_msg">
                                </div>
                                <div class="msg_cotainer">
                                        {{$message->content}}
                                        <span class="msg_time">{{$formattedTime}}</span>
                                </div>
                            </div>
                        @else
                            <div class="d-flex justify-content-end mb-4" >
                                <div class="msg_cotainer_send">
                                    {{$message->content}}
                                    <span class="msg_time_send">{{$formattedTime}}</span>
                                </div>
                                <div class="img_cont_msg">
                                    <img src="{{asset(Auth::user()->image)}}" class="rounded-circle user_img_msg">
                                </div>
                            </div>
                        @endif

                    @endforeach


                </div>
                <div class="card-footer">
                    <div class="input-group">
                        <div class="input-group-append">
                            <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
                        </div>
                        <textarea name="" id="message" class="form-control type_msg" placeholder="Type your message..."></textarea>
                        <div class="input-group-append">
                            <button class="input-group-text send_btn" id="send"><i class="fas fa-location-arrow"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('chatFormScript.ChatFormJs')

@endsection
