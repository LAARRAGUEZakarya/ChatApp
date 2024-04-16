<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ChatApp') }}</title>

        <link href="{{ asset('/chat.png') }}" rel="icon">
        <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
        <script src="{{asset('assets/js/main.js')}}"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>

        <div class="container">
            <input id="signin" type="radio" name="tab" checked="checked"/>
            <input id="register" type="radio" name="tab"/>


            <div class="pages">

                {{-- login section --}}
                <div class="page">
                    <form method="POST" action="{{route('login')}}">
                        @csrf
                        <div class="input">
                            <div class="title"><i class="fa-solid fa-user"></i>&nbsp;&nbsp; USERNAME</div>
                            <input class="text" name="email" type="text" placeholder=""/>

                        </div>

                        <div class="input">
                            <div class="title"><i class="fa-solid fa-lock"></i>&nbsp;&nbsp; PASSWORD</div>
                            <input class="text" name="password" type="password" placeholder=""/>


                        </div>
                        <div class="input">
                        <input type="submit" value="ENTER"/>
                        </div>

                        <div class="input">
                            @error('email')
                                    <small style="color:red;">
                                        <span class="title">{{ $message }}</span>
                                    </small>
                            @enderror
                        </div>
                    </form>
                </div>

                {{-- signup section --}}
                <div class="page signup">
                    <form method="POST" action="{{route('register')}}" >
                        @csrf
                        <div class="input">
                            <div class="title"><i class="fa-solid fa-user"></i>&nbsp;&nbsp; NAME</div>
                            <input class="text" name="name" type="text" placeholder=""/>
                            <div>
                                @error('name')
                                    <small style="color:red;">
                                        <span class="title">{{ $message }}</span>
                                    </small>
                                @enderror
                            </div>

                        </div>
                        <div class="input">
                            <div class="title"><i class="fa-solid fa-envelope"></i>&nbsp;&nbsp; EMAIL</div>
                            <input class="text" name="email" type="email" placeholder=""/>
                            <div>
                                @error('email')
                                        <small style="color:red;">
                                            <span class="title">{{ $message }}</span>
                                        </small>
                                @enderror
                            </div>
                        </div>
                        <div class="input">
                            <div class="title"><i class="fa-solid fa-lock"></i>&nbsp;&nbsp; PASSWORD</div>
                            <input class="text" name="password" type="password" placeholder=""/>
                                <div>
                                    @error('password')
                                            <small style="color:red;">
                                                <span class="title">{{ $message }}</span>
                                            </small>
                                    @enderror
                                </div>
                        </div>

                        <div class="input">
                        <input type="submit" value="SIGN ME UP!"/>
                        </div>
                    </form>
                </div>

            </div>

            <div class="tabs">
            <label class="tab text" for="signin">
                Sign In</label>
            <label class="tab text" for="register">
                Register</label>
            </div>
        </div>

    </body>
    </html>
