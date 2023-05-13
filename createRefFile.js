function nb_zero(i){
    //.
    // i : (int).
    //Return.
    if(i<10){
        return "00";
    } else if(i<100){
        return "0";
    } else {
        return "";
    }
}

function create_HTML(){
    //Hide the unchecked references

    for(let i=1; i<3; i++){
        let ref_id="ref"+nb_zero(i)+i+".txt";
        console.log("ref_id : "+ref_id);

        //Hide the references not chosen
        if(document.getElementById(ref_id).checked==false){
            document.getElementById("all_"+ref_id).style.display = "none";
        }

        document.getElementById(ref_id).hidden=true; //Hide the check boxes
    }
}

function create_PDF(){
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

    //Hide the buttons descritpion and buttons
    document.getElementById("intro").style.display = "none";
    document.getElementById("choice").style.display = "none";
}