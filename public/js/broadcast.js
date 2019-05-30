Vue.config.devtools = true;

var socket = io('http://127.0.0.1:3000');

var vm = new Vue({
    el: '#chat',
    data: {
        isActive: false,
        messages: [],
        friends: [],
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
                    this.scrollDown();
                })
        },
        getFirends: function () {
            axios.get('/friend/index')
                .then((response) => {
                    this.friends = response.data;
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
        scrollDown: function () {
            var objDiv          = document.getElementById("messages");
            objDiv.scrollTop    = objDiv.scrollHeight;
        },
    },
    mounted() {
        this.getLastConversation();
        this.getFirends();
        this.listen();

    },
});