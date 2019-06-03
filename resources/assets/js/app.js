import io from 'socket.io-client';
import axios from 'axios';
import Vue from 'vue';

Vue.config.devtools = true;

var socket = io('http://127.0.0.1:3000');

var vm = new Vue({
    el: '#chat',
    data: {
        isActive: false,
        messages: [],
        friends: [],
        statuses: [],
        user: {},
        content: '',
    },
    methods: {
        Broadcast: function (friendId) {
            axios.post('/message/store', {
                content: this.content,
                friendId: friendId,
            }).then(this.content = '');
        },
        getLastConversation: function () {
            axios.get('/message/index')
                .then((response) => {
                    this.messages = response.data;
                })
            this.getFirends();
        },
        getFirends: function () {
            axios.get('/friend/index')
                .then((response) => {
                    this.friends = response.data;
                })
            this.getStatues();
        },
        getStatues: function () {
            axios.get('/status/index')
                .then((response) => {
                    this.statuses = response.data;
                })
            this.getAuth();
        },
        getAuth: function () {
            axios.get('/user/getAuth')
                .then((response) => {
                    this.user = response.data;
                })
        },
        listen: function () {
            socket.on('newMessageChannel:App\\Events\\newMessage', function (data) {
                this.messages.push(data.message);
                this.friends[0].last_message.content = data.message.content;
                this.scrollDown();
            }.bind(this));
        },
        toggle: function () {
            this.isActive = this.isActive === true ? false : true;
        },
        activeStatus: function (statusId) {
            axios.post('/status/update', {
                statusId: statusId,
            }).then((response) => {
                this.user.status_id = statusId,
                    this.user.status.name = response.data,
                    this.isActive = false
            });
        },
        scrollDown: function () {
            var objDiv = document.getElementById("messages");
            objDiv.scrollTop = objDiv.scrollHeight;
        },
    },
    mounted() {
        this.getLastConversation();
        this.listen();
    },
});