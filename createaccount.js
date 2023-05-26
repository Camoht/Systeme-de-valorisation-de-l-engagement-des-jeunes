function request_ajax(){
    let xhttp = new XMLHttpRequest();
    let name='';
    let surnname='';
    let birth='';
    let email='';

    xhttp.open("POST", "createaccount.php", true);
    xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded")

    xhttp.onreadystatechange = function(){

        name=document.getElementById('name').value;
        surname=document.getElementById('surname').value;
        birth=document.getElementById('birth').value;
        email=document.getElementById('email').value;

        if(this.status === 200 && this.readyState === XMLHttpRequest.DONE){
            document.getElementById('phpreponse').innerHTML=xhttp.responseText;
        }
        xhttp.send("name="+encodedURIComponent(name)+"&surname="+encodedURIComponent(surname)+"&birth="+encodedURIComponent(birth)+"&email="+encodedURIComponent(email));

    };
    console.log('RATIO');
}
    