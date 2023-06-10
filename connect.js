document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("choice").addEventListener("submit", function(event) {

        // Prevent the unwanted transmission
        event.preventDefault();

        //Get written information by the user
        let email=document.getElementById('email').value;
        let password=document.getElementById('password').value;

        //Initialise the ajax request
        var xhr = new XMLHttpRequest();

        //Trigger the following instructions when the user clicks on the button
        xhr.onreadystatechange = function() {
            if (this.readyState ==4 && this.status == 200) {

                //Display php response
                document.getElementById("phpreponse").innerHTML = xhr.responseText;
            }
        };
        
        //Send variables to php
        xhr.open("post", document.getElementById('$GLOBALS[File][Connect][php][1]').innerText, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("email="+encodeURIComponent(email)+"&password="+encodeURIComponent(password));
    });
});