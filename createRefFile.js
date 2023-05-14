function nb_zero(i){
    // i : (int).
    //Return a string ("00" or "0") depending on i's number of figures.

    if(i<10){
        return "00";
    } else if(i<100){
        return "0";
    } else {
        return "";
    }
}

function create_HTML(){
    //Create a new window with the chosen references

    let MyW=window.open("");
    let html="<head><title>Mes références</title>";
    html+="<meta charset='utf-8'></head>";
    html+="<body><h1>Mes références</h1>";

    //Add the text of chosen references to html variable
    for(let i=1; i<3; i++){
        let ref_id="ref"+nb_zero(i)+i+".txt";
        if(document.getElementById(ref_id).checked==true){
            html+=document.getElementById("text_"+ref_id).innerHTML;
        }
    }
    html+="</body>";

    //Fill the new window
    MyW.document.open();
    MyW.document.write(html);
    MyW.document.close();

    //Alert the user, that he created his html page
    document.getElementById("alert").innerHTML="Vous avez créer une page HTML.</br>";
}

function create_PDF(){
    //

    console.log("PDF");
}

function create_file(){
    //

    //Selected format
    if(document.getElementById("HTML").checked==true){
        create_HTML();
    } else {
        create_PDF();
    }    
}