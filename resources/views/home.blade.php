@extends('layouts.app')

@section('Css')
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,300' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'>
<link href="{{ asset('css/chat.css') }}" rel="stylesheet">
@endsection

@section('content')
{{-- <h1>New Users</h1>
    <ul>
        <li v-for='user in users' v-text='user'></li>
    </ul>
    <form @submit.prevent='Broadcast'>

        <input type="text" placeholder="Insert name" v-model='NewName'>
        <button>Add</button>
    </form> --}}

<div id="frame">
    <div id="sidepanel">
        <div id="profile">
            <div class="wrap">
                <img id="profile-img" src="{{asset('storage/userImages/'.$user->image)}}" alt=""
                    class="{{$user->status->name}}" @click='toggle()' />
                <p>{{$user->name}}</p>
                <div id="status-options" :class='{ active: isActive }'>
                    <ul>
                        @foreach ($statuses as $status)
                            <li id="status-{{$status->name}}" @if($status->id == $user->status_id)
                                class="active" @endif onclick='active("status-{{$status->name}}")'>
                                <span class="status-circle"></span>
                                <p>{{$status->name}}</p>
                            </li>
                        @endforeach
                </div>
            </div>
        </div>
        <div id="search">
            <label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
            <input type="text" placeholder="Search contacts..." />
        </div>
        <div id="contacts">
            <ul>
                @foreach ($friends as $index=>$friend)
                <li class="contact" @if($index==0)class='active' @endif>
                    <div class="wrap">
                        <span class="contact-status {{$friend->user->status->name}}"></span>
                        <img src="{{asset('storage/userImages/'.$friend->user->image)}}" alt="" />
                        <div class="meta">
                            <p class="name">{{$friend->user->name}}</p>
                            <p class="preview">
                                {{ mb_substr($friend->messages->first()->content, 0, 100, 'utf-8') }}
                                {{ strlen($friend->messages->first()->content) > 100 ? '...' : "" }}
                            </p>
                        </div>
                    </div>
                </li>
                @endforeach

            </ul>
        </div>
        <div id="bottom-bar">
            <button id="addcontact"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> <span>Add
                    contact</span></button>
            <button id="settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>Settings</span></button>
        </div>
    </div>
    <div class="content">
        <div class="contact-profile">
            <img src="{{asset('storage/userImages/'.$LastFriend->user->image)}}" alt="" />
            <p>{{$LastFriend->user->name}}</p>
        </div>
        <div class="messages">
            <ul>
                @foreach ($LastFriend->messages as $message)
                    <li class="{{$message->user_id==$user->id?"sent":"replies"}}">
                        <img src="{{asset('storage/userImages/'.$message->user->image)}}" alt="" />
                        <p>{{$message->content}}</p>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="message-input">
            <div class="wrap">
                <form @submit.prevent='Broadcast'>
                    <input type="text" placeholder="Write your message..." v-model='NewName'>
                    <button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('Js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.js"></script>
<script type="text/javascript" src="{{ asset('js/chat.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/broadcast.js') }}"></script>
@endsection