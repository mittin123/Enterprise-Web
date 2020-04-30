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
            messageClients(POST.data,data.client_id);
            
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

websocketServer.on("request",function(webSocket){
    var client_id  = parseInt(webSocket.resource.substr(1));
    clients[client_id] = webSocket;
    var connection = webSocket.accept(null, webSocket.origin);
    clients[client_id] = connection;
    clients[client_id].client_id = client_id;
    console.log("connected "+client_id+ " in "+Object.getOwnPropertyNames(clients));
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

function messageClients(message,client_id){
    for(var i in clients){
        if(clients[i].client_id = client_id){
            console.log(i + "-- element i");
            console.log(client_id + "-- send client id");
            clients[i].sendUTF(message);
        }
    }
}
