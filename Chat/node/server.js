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
            messageClients(POST.data);
            console.log(POST.data);
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

websocketServer.on("request",websocketRequest);

global.clients = {};
var connection_id = 0;
function websocketRequest(request){
    var connection = request.accept(null, request.origin);
    connection_id++;

    clients[connection_id] = connection;
}

function messageClients(message){
    for(var i in clients){
        clients[i].sendUTF(message);
    }
}
