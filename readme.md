# RealTimeChat

## Intro
more like messenger you can send and reply messages to your friends.

## used technologies
1. Laravel
2. Vue.js
3. Node.JS (with Socket.io package)
4. Redis

## description
### sequence  diagram 
 ![alt text](https://github.com/ahmedwael49674/RealTimeChat/blob/master/diagrames/sequance.jpg)
1. node.js subscribe to the channel.
2. Vue.js listen to the node.js port (which events will be emitted over it).
3. user send message to his friend the MessageController will receive it.
4. message controller will send the message content to the database to store it.
5. message controller will call the event newMessage which will broadcast the data over the channel.
6. node.js receive the event and emit it.
5. vue will receive the event and push the data through the object messages which will automatically bind over the view.

### ERD  diagram 
 ![alt text](https://github.com/ahmedwael49674/RealTimeChat/blob/master/diagrames/ERD.jpg)
 1. statuses: store for basic user static status (online, away, offline, busy)
 2. users: store all the user's data within the system.
 3. friends: it's a many-to-many relationship with the user as (user_one, user_two) used to store friendship and give it id.
 4. message: store message content and the sender id as user_id and friend_id which is the friendship id from table friends (with this id make it easier to get all conversation messages)
 
##How to run?
1. git clone the project
2. composer install
3. npm install
4. create the database
5. copy .env.exmple to .env and change database username and password
6. run the migrations (php artisan migrate)
7. run the seeder (php artisan db:seed)
8. run socket.js (node socket.js)
9. run the project (php artisan serve)
