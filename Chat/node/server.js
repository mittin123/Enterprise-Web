"use strict";
var http = require('http');
var url = require('url');

var WebsocketServer = require('websocket').server;
var sender_id = 0;
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
            sender_id = data.sender_id;
            messageClients(POST.data, data.receiver_id, data.sender_id);
            
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
//websocketServer.on("request",websocketRequest);
var connection_id = 0;
websocketServer.on("request",function(webSocket){
    var params = webSocket.resource.split('&');
    var receiver_id  = parseInt(params[0].substr(5));
    var sender_id  = parseInt(params[1].substr(7));
    clients[connection_id] = webSocket;
    var connection = webSocket.accept(null, webSocket.origin);
    clients[connection_id] = connection;
    clients[connection_id].receiver_id = receiver_id;
    clients[connection_id].sender_id = sender_id;
    console.log("connected "+receiver_id+ " in "+Object.getOwnPropertyNames(clients));
    console.log(receiver_id);
    console.log(sender_id);
    connection_id++;
})
/*
var connection_id = 0;
function websocketRequest(request){
    var random_client_id = Math.floor(Math.random() * 1000) + 1;
    var connection = request.accept(null, request.origin);
    connection_id++;
    clients[connection_id] = connection;
    clients[connection_id].client_id = random_client_id;
    console.log("connected " + request.origin);
    console.log(clients[1].client_id);
    
}*/

function messageClients(message,get_id,sender_id){
    for(var i in clients){
        clients[i].sendUTF(message);
    }
        
}

