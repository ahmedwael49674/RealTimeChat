@extends('layouts.app')

@section('Css')
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,300' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'>
<link rel='stylesheet' href="{{ asset('css/chat.css') }}" rel="stylesheet">
@endsection

@section('content')
<div id="frame">
    <div id="sidepanel">
        <div id="profile">
            <div class="wrap">
                <img id="profile-img" :src="user.image" :class="user.status.name" @click='toggle()' />
                <p v-text='user.name'></p>
                <div id="status-options" :class='{ active: isActive }'>
                    <ul>
                        <li v-for='status in statuses' :id="'status-'+status.name"
                            :class='{ active: status.id === user.status_id }' @click='activeStatus(status.id)'>
                            <span class="status-circle"></span>
                            <p v-text='status.name'></p>
                        </li>
                </div>
            </div>
        </div>
        <div id="search">
            <label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
            <input type="text" placeholder="Search contacts..." />
        </div>
        <div id="contacts">
            <ul>
                <li class="contact" v-for='(friend,index) in friends' :class="{ 'active': index == 0 }">
                    <div class="wrap">
                        <span class="contact-status" :class='friend.user.status.name'></span>
                        <img :src="friend.user.image" />
                        <div class="meta">
                            <p class="name" v-text='friend.user.name'></p>
                            <p class="preview">
                                @{{friend.last_message.content.substring(0, 100)}}
                            </p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div id="bottom-bar">
            <button id="addcontact">
                <i class="fa fa-user-plus fa-fw" aria-hidden="true"></i>
                <span>Add contact</span>
            </button>
            <button id="settings">
                <i class="fa fa-cog fa-fw" aria-hidden="true"></i>
                <span>Settings</span>
            </button>
        </div>
    </div>
    <div class="content">
        <div class="contact-profile" v-if='friends[0]'>
            <img :src="friends[0].user.image" />
            <p v-text='friends[0].user.name'></p>
        </div>
        <div class="messages" id="messages">
            <ul>
                <li v-for='message in messages' :class=message.is_auth?'sent':'replies'>
                    <img :src="message.user.image">
                    <p v-text='message.content'></p>
                </li>
            </ul>
        </div>
        <div class="message-input">
            <div class="wrap">
                <form @submit.prevent='Broadcast({{$LastFriendConversation->id}})'>
                    <input type="text" placeholder="Write your message..." v-model='content'>
                    <button class="submit">
                        <i class="fa fa-paper-plane" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection