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

function table_text(text, table){
    // .
    let line=-1;
    let col=-1;
    let word=0;
    table[0]=Array();
    table[0][0]=Array();
    for (let i=0; i<text.length; i++){
        if(text[i]=="<") { //Some balise
            while(text[i]!=">"){
                i++;
                if(text.substr(i, 5)=='tbody'){ //    tbody
                    i+=4;
                } else if(text.substr(i, 6)=='/tbody') { //   /tbody
                    i+=5;
                } else if(text.substr(i, 2)=='tr') { //   tr
                    line++;
                    col=-1;
                    word=0;
                    i+=1;
                } else if(text.substr(i, 3)=='/tr') { //   /tr
                    word=0;
                    i+=2;
                } else if(text.substr(i, 2)=='td') { //    td
                    word=0;
                    col++;
                    i+=1;
                } else if(text.substr(i, 3)=='/td') { //   /td
                    word=0;
                    i+=2;
                } else if(text.substr(i, 5)=='table' && line!=-1 && col!=-1) { //   table
                    // Provide the reading of table balise twice
                    while(text[i]!=">"){
                        i++;
                    }
                    i++;

                    table[line][col]=Array();
                    table[line][col]=table_text(text.slice(i), table[line][col]);

                    // Provide the reading of table balise twice
                    while(text.substr(i, 6)!='/table'){
                        i++;
                    }
                    i++;
                } else if(text.substr(i, 6)=='/table') { //   /table
                    return table;
                }
            } 
        } else if(text[i]=="\n") { //    /n
        } else if(text.substr(i, 4)=="    ") { //   tab
            i+=3;
        } else { // text
            if(line!=0 && col==0 && word==0) {
                table.splice(line, 0, Array(Array(text[i])));
            } else if (col!=0 && word==0){
                table[line].splice(col, 0, Array(text[i]));
            } else {
                table[line][col].splice(word, 0, text[i]);
            }
            word++;
        }
    }
    return table;
}

function letter_h(letter){
    return 4;
}

function letter_w(letter){
    if (letter = letter.toUpperCase) {
        return 3.2;
    } else if(letter=='i' || letter=='l'){
        console.log('i')
        return 0.5;
    } else {
        return 1;
    }
}

function max_col(table){ //!L'erreur est dans cette fonctjion ou dans son utilisation!
    // .
    // table :(array).
    // Return.

    //Fill max variable with 0's
    let max=Array(0);
    for(let i=0; i<table.length; i++){
        for(let j=0; j<table[i].length;j++){
            max[j]=0;
        }
    }

    //Fill max variable with maximum lenght
    for(i=0; i<table.length; i++){
        for(j=0; j<table[i].length;j++){
            if(typeof(table[i][j][0])=="object"){
            } else {

                //Count width of word
                let width=0;
                for(let k=0; k<table[i][j].length; k++){
                    width+=letter_w(table[i][j][k]);
                }

                //
                if(width>max[j]){
                    max[j]=width;
                }
            }
        }
    }
    return max;
}

function place_table_in_PDF(pdf, table, start_h, start_w){
    //Add the text of chosen references to the PDF file
    let max_l_col=max_col(table);
    let line=start_h;
    let col=start_w;
    let col_w=0;
    for(let i=0; i<table.length; i++){
        for(let j=0; j<table[i].length; j++){
            for(let k=0; k<table[i][j].length; k++){
                if(typeof(table[i][j][k])=="object"){

                    //
                    line+=letter_h("");
                    place_table_in_PDF(pdf, table[i][j][k], line, col);
                } else {

                    //
                    pdf.fromHTML(table[i][j][k], col+col_w, line);
                }
                col_w+=letter_w(table[i][j][k]);
            }
            col+=max_l_col[j];
            col_w=0;
        }
        line+=letter_h("");
        col=start_w;
    }
    return line;
}

function create_PDF(){
    // .

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

    let start_h=5;
    const start_w=5;

    //Add title to the PDF file
    pdf.fromHTML("Mes références", start_w+10, start_h);
    start_h+=2*letter_h("");

    //Add the text of chosen references to the PDF file
    let text="";
    for(let i=1; i<=document.getElementById('valider').value; i++){
        let ref_id="ref"+nb_zero(i)+i+".txt";
        if(document.getElementById(ref_id).checked==true){

            text=document.getElementById("text_ref"+nb_zero(i)+i+".txt").innerHTML;

            //Create array containing the text
            let table=Array();
            table=table_text(text, table);
        
            //Add the text of chosen references to the PDF file
            start_h=place_table_in_PDF(pdf, table, start_h, start_w);
            start_h+=2*letter_h("");
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