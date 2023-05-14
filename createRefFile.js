function nb_zero(i){
    //Use to create a number with 3 figures.
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
    //Create a new window with the chosen references.

    let MyW=window.open("");
    let html="<head><title>Mes références</title>";
    html+="<meta charset='utf-8'></head>";
    html+="<body><h1>Mes références</h1>";

    //Add the text of chosen references to html variable
    for(let i=1; i<=document.getElementById('valider').value; i++){
        console.log(i);
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
    //Create a PDF file with the chosen references.

    //Setting the PDF file
    var pdf = new jsPDF({
        orientation: 'p',
        unit: 'mm',
        format: 'a5',
        putOnlyUsedFonts:true
    });
    pdf.setFont("helvetica");
    pdf.setFontSize(9);

    //Add the text of chosen references to text variable
    let text="";
    for(let i=1; i<=document.getElementById('valider').value; i++){
        let ref_id="ref"+nb_zero(i)+i+".txt";
        if(document.getElementById(ref_id).checked==true){
            text+=document.getElementById("text_"+ref_id).innerText;
        }
    }

    //Fill the new PDF file
    pdf.text(text, 20, 20);
    pdf.save('Mes_references.pdf');

    //Alert the user, that he created his PDF file
    document.getElementById("alert").innerHTML="Vous avez créer une page HTML.</br>";
}

function create_file(){
    //Create PDF file or an HTML one with the chosen references.

    //Choose the selected format
    if(document.getElementById("HTML").checked==true){
        create_HTML();
    } else {
        create_PDF();
    }    
}