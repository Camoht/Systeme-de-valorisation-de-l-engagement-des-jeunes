document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("choice").addEventListener("submit", function(event) {

        // Prevent the unwanted transmission
        event.preventDefault();

        //Get written information by the user
        let name=document.getElementById('name').value;
        let surname=document.getElementById('surname').value;
        let birth=document.getElementById('birth').value;
        let email=document.getElementById('email').value;
        let password=document.getElementById('password').value;

        //Initialise the ajax request
        var xhr = new XMLHttpRequest();

        //Trigger the following instructions when the user clicks on the button
        xhr.onreadystatechange = function() {
            if (this.readyState ==4 && this.status == 200) {

                //Display php response
                //document.getElementById("phpreponse").innerHTML = xhr.responseText;
            }
        };


        //Send variables to php
        xhr.open("post", "profile.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("name="+encodeURIComponent(name)+"&surname="+encodeURIComponent(surname)+"&birth="+encodeURIComponent(birth)+"&email="+encodeURIComponent(email)+"&password="+encodeURIComponent(password));
    });
});