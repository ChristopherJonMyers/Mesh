// Creating a new user
function createUser() {

    let _username = document.getElementById("username").value;
    let _pass = document.getElementById("pass").value;
    let _passCheck = document.getElementById("passCheck").value;
    let _firstName = document.getElementById("userFirst").value;
    let _lastName = document.getElementById("userLast").value;

    if (_pass !== _passCheck) {
        document.getElementById("message").innerHTML = "Passwords do not match.";
        return;
    }

    if (validate([_username, _pass, _firstName, _lastName])) {
        let creds = {
            username: _username,
            pass: _pass,
            firstName: _firstName,
            lastName: _lastName
        }
        let encodedObj = JSON.stringify(creds);
        encodedObj = "object="+encodedObj;

        let request = new XMLHttpRequest();
        let url = "store_user.php";

        request.open("POST", url, true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                window.location.href = "home.php";
            }
        }

        request.send(encodedObj);
    }

    //document.getElementById("message").innerHTML = "Passwords match.";
}

function checkusername(username) {
    let str = "object="+username;
    
    let userCheck = new XMLHttpRequest();
    let url = "user_val.php";

    userCheck.open("POST", url, true);
    userCheck.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    userCheck.onreadystatechange = function () {
        if (userCheck.readyState == 4 && userCheck.status == 200) {
            let taken = userCheck.responseText;
            taken = JSON.parse(taken);
            if (!taken) {
                createUser();
            }
            else {
                document.getElementById("message").innerHTML = "Username already taken.";
            }
        }
    }
    userCheck.send(str);

}

function sendLogin(_username, _password) {
    
}