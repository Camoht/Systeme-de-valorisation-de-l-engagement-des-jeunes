document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("choice").addEventListener("submit", function(event) {

        // Prevent the unwanted transmission
        event.preventDefault();

        //Initialise the variables
        let name='';
        let surname='';
        let birth='';
        let email='';

        //Initialise the ajax request
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "createaccount.php?", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        //Trigger the following instructions when the user clicks on the button
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {

                console.log("Je rempli les valeurs");

                //Get written information by the user
                name=document.getElementById('name').value;
                surname=document.getElementById('surname').value;
                birth=document.getElementById('birth').value;
                email=document.getElementById('email').value;

                //Display php response
                document.getElementById("phpreponse").innerHTML = xhr.responseText;

                xhr.send("name="+encodeURIComponent(name)/*+"&surname="+encodeURIComponent(surname)+"&birth="+encodeURIComponent(birth)+"&email="+encodeURIComponent(email)*/);
            }
        };

        console.log (name)
        console.log (surname)
        console.log (birth)
        console.log (email)

        //Send variables to php
        //xhr.send("name="+encodeURIComponent(name)/*+"&surname="+encodeURIComponent(surname)+"&birth="+encodeURIComponent(birth)+"&email="+encodeURIComponent(email)*/);

        console.log("Fin du js");
    });
});