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
    document.getElementById("alert").innerHTML="Vous avez créé une page HTML.</br>";
}

function create_PDF(){
    //Create a PDF file with the chosen references.
    //Inspired with : https://codepen.io/amkid/pen/qKYwXo

    //Setting the PDF file
    var pdf = new jsPDF({
        orientation: 'p',
        unit: 'mm',
        format: 'a5',
        putOnlyUsedFonts:true
    });
    pdf.setFont("helvetica");
    pdf.setFontSize(9);
    pdf.setTextColor(0,0,0);

    var specialElementHandlers = {
        'tr' : function (element, renderer){
            renderer.setFontStyle('normal');
        }
    };

    //Add the text of chosen references to the PDF file
    let nb_pages=0;
    for(let i=1; i<=document.getElementById('valider').value; i++){
        console.log(i);
        let ref_id="ref"+nb_zero(i)+i+".txt";
        if(document.getElementById(ref_id).checked==true){
            pdf.fromHTML(document.getElementById("text_"+ref_id).innerHTML, 5, -5+500*nb_pages,{
                'elementsHandlers' : specialElementHandlers
            });
            nb_pages++;
            console.log("nb_pages"+nb_pages);
        }
    }
    pdf.save('MesReferences.pdf');

    //Alert the user, that he created his PDF file
    document.getElementById("alert").innerHTML="Vous avez créé un fichier PDF.</br>";
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