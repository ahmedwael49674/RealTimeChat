Vue.config.devtools = true;

var socket = io('http://127.0.0.1:3000');

new Vue({
    el: '#chat',
    data: {
        isActive: false,
        users: [],
        NewName: ''
    },
    methods: {
        Broadcast: function () {
            axios.post('/storeUser', {
                    newName: this.NewName
                }).then(this.NewName = '');
        },
        toggle:function(){
            this.isActive = this.isActive === true ? false : true;
        }
    },
    mounted: function () {
        socket.on('testChannel:App\\Events\\newName', function (data) {
            this.users.push(data.userName);
        }.bind(this));
    },
});
