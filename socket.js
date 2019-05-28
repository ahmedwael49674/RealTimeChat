var server = require('http').Server();

var io = require('socket.io')(server);

var Redis = require('ioredis'); // redis clint return class
var redis = new Redis(); //create object

redis.subscribe('testChannel');

//listen when there is any data pushed to the channel
redis.on('message', function (channel, message) {
    console.log('event recived');
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data); //test-Channel : App\\Events\\newName
});

server.listen(3000);