var express = require('express');
var app = express();
var http = require('http').Server(app);
var io = require('socket.io')(http, { cors:{
        origin: "http://127.0.0.1:8000"
    }});

var mysql = require('mysql');
var moment = require('moment');
var sockets = {};
var con = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '2020',
    database: 'workmap'
});

con.connect(function (err){
    if (err)
        throw err;
    console.log("Database connected");
});

io.on('connection', function (socket) {
    if (!sockets[socket.handshake.query.user_id]) {
        sockets[socket.handshake.query.user_id] = [];
    }
    sockets[socket.handshake.query.user_id].push(socket);
    socket.broadcast.emit('user_connected', socket.handshake.query.user_id);

    con.query(`UPDATE users
               SET is_online=1
               WHERE id = ${socket.handshake.query.user_id}`, function (err, res) {
        if (err)
            throw err;
        console.log('user_Connected', socket.handshake.query.user_id);
    });

    socket.on('send_message', function (data){
        var group_id = (data.user_id>data.other_user_id)?data.user_id+data.other_user_id:data.other_user_id+data.user_id;
        var time = moment().format("h:mm A");
        data.time = time;

        con.query(`INSERT INTO chats (user_id, other_user_id, message, group_id) values('${data.user_id}',
                   '${data.other_user_id}', '${data.message}', '${group_id}')`, function (err, res){
            if (err)
                throw err;
            data.id = res.insertId;
            for (var i in sockets[data.user_id]){
                sockets[data.user_id][i].emit('receive_message', data);
            }
            con.query(`SELECT COUNT(id) as unread_message from chats where user_id=${data.user_id} and other_user_id=${data.other_user_id} and is_read=0`, function (err, res) {
                if (err)
                    throw err;
                data.unread_message = res[0].unread_message;
                for (var j in sockets[data.other_user_id]){
                    sockets[data.other_user_id][j].emit('receive_message', data);
                }
            });
        });
    });

    socket.on('read_message', function (id) {
        con.query(`UPDATE chats SET is_read = 1 where id=${id}`, function (err, res) {
            if (err)
                throw err;
            console.log('message read');
        });
    });

    socket.on('user_typing', function (data) {
        for (var j in sockets[data.other_user_id]){
            sockets[data.other_user_id][j].emit('user_typing', data);
        }
    });

    socket.on('disconnect', function (err){
        socket.broadcast.emit('user_disconnect', socket.handshake.query.user_id);
        for (var index in sockets[socket.handshake.query.uuser_id]){
            if (socket.id === sockets[socket.handshake.query.user_id][index].id){
                sockets[socket.handshake.query.user_id].splice(index, 1);
            }
        }
        con.query(`UPDATE user
    s SET is_online=0 WHERE id=${socket.handshake.query.user_id}`, function (err, res){
            if (err)
                throw err;
            console.log('user Disconnected', socket.handshake.query.user_id);
        });
    });
});

http.listen(3000);
