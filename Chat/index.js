var sender = document.getElementById("sender"),
    send_message = document.getElementById("message");

function handleKeyUp(e){
    if(e.keyCode === 13){
        sendMessage();
    }
}

function sendMessage() {
    var name = sender.value.trim(),
        message = send_message.value.trim();
        
    
        if(!name){
            return alert("Please fill in the name");
        }

        if(!message){
            return alert("Please input your message");
        }

        var ajax = new XMLHttpRequest();
        ajax.open("POST","send.php",true);
        ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        ajax.send("name="+name+"&message="+message+"&client_id="+client_id);

        send_message.value = "";
}

  window.WebSocket = window.WebSocket || window.MozWebSocket;
  console.log(client_id);
  var connection = new WebSocket('ws://localhost:8888/'+client_id);
  var connectionSpan = document.getElementById("connecting");
  connection.onopen = function(){
      //connectionSpan.style.display = "none";
      connectionSpan.innerHTML = "Connect success";
  };

  connection.onerror = function(error){
    connectionSpan.innerHTML = "Something wrong";
  };

  connection.onmessage = function(message){
      var data = JSON.parse(message.data);

      var div = document.createElement("div");
      var author = document.createElement("span");
      author.className = "author";
      author.innerHTML = data.name;
      var message = document.createElement("span");
      message.className = "message";
      message.innerHTML = data.message;

      div.appendChild(author);
      div.appendChild(message);

      document.getElementById("message-box").appendChild(div);
  }