'use strict';

let fs = require( 'fs' );
let app = require('express')();
let https = require('https');
let server = https.createServer({
    key: fs.readFileSync('/etc/nginx/ssl/key.key'),
    cert: fs.readFileSync('/etc/nginx/ssl/dovedating_com.chained.crt'),
    requestCert: false,
    rejectUnauthorized: false
},app);
server.listen(8890);

let io = require('socket.io').listen(server);
let request = require('request');
let Redis = require('ioredis'),
    redis = new Redis();

io.use((socket, next) => {
    request.get({
        url: 'https://dovedating.com/ws/check-auth',
        headers: { cookie: socket.request.headers.cookie },
        json: true
    }, function (error, response, json) {
        console.log(json);
        return json.auth ? next() : next(new Error('Auth error'));
    });
})

io.on('connection', function (socket) {
    let users = [];

    socket.on('subscribe',  (channel) => {
        request.get({
            url: 'https://dovedating.com/ws/check-sub/' + channel,
            headers: { cookie: socket.request.headers.cookie },
            json: true
        }, function (error, response, json) {
            console.log(json);
            if(json.can) {
                if(!socket.rooms[channel]){
                    socket.join(channel, function (error) {
                        users[socket.id] = channel;
                        console.log('join');
                        socket.send('Join to ' + channel);
                    });
                }
                return;
            }
        });
    });

    socket.on('disconnect', (channel) => {
        request.get({
            url: 'https://dovedating.com/ws/disconnect/' + users[socket.id],
            headers: { cookie: socket.request.headers.cookie },
            json: true
        }, function (error, response, json) {
            console.log('disconnect: ' + users[socket.id]);
        });
    });
})

redis.psubscribe('*', function (error, count) {
    // ...
});

redis.on('pmessage', (pattern, channel, message) => {

    message = JSON.parse(message);
    io
        .to(channel)
        .emit(channel, message.data);

    console.log(message.event);
});