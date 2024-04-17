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
                        <li>
                            <a href="{{route('chatForm',$user->id)}}" class="d-flex bd-highlight" style="text-decoration: none;">
                                <div class="img_cont">
                                    <img src="{{$user->image}}" class="rounded-circle user_img">
                                    <span class="online_icon"></span>
                                </div>
                                <div class="user_info">
                                    <span>{{$user->name}}</span>
                                    <p>{{$user->name}} is online</p>
                                </div>
                            </a>
                        </li>
                @endforeach
                </ui>
            </div>
            <div class="card-footer"></div>
        </div></div>
    </div>
</div>

@endsection
