
// Below function Executes on click of login button.

function validate(){
    var username = document.getElementById("username").value;
    var useremail = document.getElementById("useremail").value;
    var password = document.getElementById("password").value;
            if ( (username == "" || null) || (password == "" || null)||(useremail == "" || null)){
                alert ("Please fill the form");
                return false;
            }
            else{
                return true;
            }

}