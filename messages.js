var conversations;
var activeConversation;
var activeUsername;

function retrieveMessages() {
    var url = "messages.php";
    let getMessages = new XMLHttpRequest();
    
    getMessages.open("POST", url, true);
    getMessages.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    getMessages.onreadystatechange = function() {
        if (getMessages.readyState == 4 && getMessages.status == 200) {
            let data = getMessages.responseText;
            data = JSON.parse(data);
            listConvos(data);
            activeConversation = Object.keys(data)[0];
            getMessagesConvo(activeConversation);
        }
    }
    getMessages.send();
}

function retrieveNewMessages() {
    var url = "message_update.php";
    var getMessages = new XMLHttpRequest();
    
    getMessages.open("POST", url, true);
    getMessages.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    getMessages.onreadystatechange = function() {
        if (getMessages.readyState == 4 && getMessages.status == 200) {
            let data = getMessages.responseText;
            data = JSON.parse(data);
            if (data.length > 0) implementNewMessages(data);
        }
    }
    getMessages.send();
}

function listConvos(convs) {
    document.getElementById("conversations").innerHTML = "";
    for (let k in convs) {
        createConvo(convs[k], k);        
    }
}

function implementNewMessages(msgs) {
    for (var n = 0; n < msgs.length; n++) {
        if (activeConversation == "0" + msgs[n][0].toString()) {
            createMessageBubble(msgs[n][1].content, msgs[n][1].sender);
        }
        else {
            
        }
        updateConvo(msgs[n][1].content, msgs[n][1].datetime);
    }
    retrieveMessages();
}

function list_messages(conv) {
    document.getElementById("convUser").innerHTML = "<img src='images/"+conv[1]+"' style='height: 40px; width: 40px; margin:auto'> " + conv[0];
    var div = document.getElementById("messages");
    div.innerHTML = "";
    for (var j = conv.length-1; j > 1; j--) {
        createMessageBubble(conv[j].content, conv[j].sender);
    }
    div.scrollTop = div.scrollHeight;
}

function createMessageBubble(content, user) {
    var div = document.createElement("div");
    let holderDiv = document.createElement("div");
    holderDiv.classList.add("messageHolder");
    div.innerHTML = content;
    div.classList.add("message");
    if (user) {
        div.classList.add("userMessage");
    }
    else {
        div.classList.add("contactMessage");
    }
    
    holderDiv.appendChild(div);
    var messageHolder = document.getElementById("messages");
    //messageHolder.insertBefore(holderDiv, messageHolder.childNodes[0]);
    var div2 = document.getElementById("messages");
    div2.appendChild(holderDiv);
    holderDiv.style.height = (div.offsetHeight + 32).toString() + "px";
    div2.scrollTop = div2.scrollHeight;
}

function createConvo(conv, id) {
    let div = document.createElement("div");
    div.style = "width: 100%; height: 50px; border: 1px solid black";
    div.classList.add("convoListing");
    div.innerHTML = "<b>(" + conv.username + ")</b>  -  " + adjustedLastMsg(conv.first.content) + "<br>" + adjustedDate(conv.last_message);
    div.id = id;
    div.onclick = function() { toggle(2); getMessagesConvo(this.id); };
    document.getElementById("conversations").appendChild(div);
}

function adjustedLastMsg(message) {
    if (message.length > 18) {
        return message.substring(0,19) + "...";
    }
    else {
        return message;
    }
}

function adjustedDate(date) {
    var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];
    var dt = new Date(date);
    var mins = (dt.getMinutes() > 9 ? dt.getMinutes() : ("0" + dt.getMinutes().toString()));
    var dateStr = dt.getDate() + " " + months[dt.getMonth()] + " " + dt.getHours() + ":" + mins;
    return dateStr;
}

function getMessagesConvo(id) {
    let convMsgRequest = new XMLHttpRequest();
    let url = "get_conv_messages.php";
    var convId = "obj="+id;
    
    convMsgRequest.open("POST", url, true);
    convMsgRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    convMsgRequest.onreadystatechange = function() {
        if (convMsgRequest.readyState == 4 && convMsgRequest.status == 200) {
            var data = convMsgRequest.responseText;
            data = JSON.parse(data);
            list_messages(data);
            activeUsername = data[0];
            activeConversation = id;
        }
    }
    convMsgRequest.send(convId);
}

function prepareMessage() {
    var content = document.getElementById("convMsg").value;
    sendMessage(activeUsername, content);
}

function sendMessage(_recipient, _content) {
    let msgRequest = new XMLHttpRequest();
    let url = "store_message.php";
    
    var obj = {recipient:_recipient, content:_content};
    var jsonobj = JSON.stringify(obj);
    var object = "object="+jsonobj;
    
    msgRequest.open("POST", url, true);
    msgRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    msgRequest.onreadystatechange = function() {
        if (msgRequest.readyState == 4 && msgRequest.status == 200) {
            document.getElementById("convMsg").value = "";
            createMessageBubble(_content, true);
            //updateConvo(_content, msgRequest.responseText);
            retrieveMessages();
        }
    }
    
    msgRequest.send(object);
}

function updateConvo(content, date) {
    var convo = document.getElementById(activeConversation);
    if (convo) {
        convo.innerHTML = adjustedLastMsg(content) + "<br>" + adjustedDate(date);
    }
}

function addListener() {
document.getElementById("recipient").addEventListener("input", function(event) {
                var request = new XMLHttpRequest();
                var url = "users.php";
                var userSearch = "obj="+document.getElementById("recipient").value;
                request.open("POST", url, true);
                request.onreadystatechange = function () {
                    if (request.readyState == 4 && request.status == 200) {
                        var return_data = request.responseText;
                        var data = JSON.parse(return_data);
                        var options = document.getElementById("recipientMatches");
                        options.innerHTML = "";
                        data.forEach(function (elem) {
                            var opt = document.createElement("option");
                            opt.innerHTML = elem;
                            options.appendChild(opt);
                        })
                    }
                }
                request.send(userSearch);
            })
}

function startBlankConvo() {
    var user = document.getElementById("recipient").value;
    userExists(user);
}

function startConvo(bool, user) {
    if (bool) {
        document.getElementById("messages").innerHTML = "";
        document.getElementById("convUser").innerHTML = user;
        activeUsername = user;
        document.getElementById("recipient").value = "";
        toggle(2);
    }
}

function userExists(user) {
    var request = new XMLHttpRequest();
    var url = "get_user.php";
    var obj = "obj="+user;
    
    request.open("POST", url, true);
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var return_data = request.responseText;
            var data = JSON.parse(return_data);
            startConvo(data, user);
        }
    }
    request.send(obj);
}

function toggle(view) {
    if (view == 2) {
        document.getElementById("collapseExample").style.display = "none";
        document.getElementById("messagesHolder").style.display = "block";
    }
    else {
        document.getElementById("collapseExample").style.display = "block";
        document.getElementById("messagesHolder").style.display = "none";
    }
}

window.setInterval(function(){
  retrieveNewMessages();
}, 1000);
