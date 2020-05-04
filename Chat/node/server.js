"use strict";
var http = require('http');
var url = require('url');

var WebsocketServer = require('websocket').server;
var server = http.createServer(function(request,response){
    function getPostParam(request, callback){
        var qs = require('querystring');
        if(request.method == 'POST'){
            var body = '';
            request.on('data',function(data){
                body += data;
                if(body.length > 1e6){
                    request.connection.destroy();
                }
            });

            request.on('end',function(){
                var post = qs.parse(body);
                callback(post);
            })
        }
    }

    if(request.method === "POST"){
        getPostParam(request,function(POST){
            var data = JSON.parse(POST.data);
            var room_id = data.room_id;
            console.log("Send roomid "+JSON.stringify(data));
            messageClients(POST.data, room_id);
            
            response.writeHead(200);
            response.end();
        });
        return;
    }
});
server.listen(8888);

var websocketServer = new WebsocketServer({
    httpServer: server
});
global.clients = {};
global.connection_list = {};
var connection_id = 0;
var room_id = 0;
global.connection_list[connection_id] = [];
//websocketServer.on("request",websocketRequest);
websocketServer.on("request",function(webSocket){
    console.log(webSocket.resource);
    room_id  = parseInt(webSocket.resource.substr(1));
    var connection = webSocket.accept(null, webSocket.origin);
    clients[connection_id] = connection;
    connection_list[connection_id] = room_id;
    console.log("Room ID "+connection_list[connection_id]+ " has been created. Current client_num:"+Object.getOwnPropertyNames(clients));
    console.log(connection_list[connection_id]);
    connection_id++;
})

function messageClients(message,room_id){
    for(var i in clients){
        if(connection_list[i] == room_id){
            console.log("123123123");
            clients[i].sendUTF(message);
        }
        console.log("-- RoomID "+room_id);
        console.log("-- connection_list roomid "+connection_list[i]);
    }
}

