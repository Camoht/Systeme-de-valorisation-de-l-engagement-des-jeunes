function nb_zero(i){
    // Use to create a number with 3 figures.
    // i : (int).
    // Return "00", "0" or "" depending on i's number of figures (string).

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
    // Translate html text into an array.
    // text : (string) html content of a table (witch contains a table in the last cell).
    // table : (array).
    // Return the table variable (array).

    //Initialisation variables
    let line=-1;
    let col=-1;
    let word=0;
    table[0]=Array();
    table[0][0]=Array();

    //Read the text variable
    for (let i=0; i<text.length; i++){
        if(text[i]=="<") { //Check tags
            while(text[i]!=">"){
                i++;
                if(text.substr(i, 5)=='tbody'){ //  tbody's tag
                    i+=4;
                } else if(text.substr(i, 6)=='/tbody') { //   /tbody's tag
                    i+=5;
                } else if(text.substr(i, 2)=='tr') { //   tr's tag
                    line++;
                    col=-1;
                    word=0;
                    i+=1;
                } else if(text.substr(i, 3)=='/tr') { //   /tr's tag
                    word=0;
                    i+=2;
                } else if(text.substr(i, 2)=='td') { //    td's tag
                    word=0;
                    col++;
                    i+=1;
                } else if(text.substr(i, 3)=='/td') { //   /td's tag
                    word=0;
                    i+=2;
                } else if(text.substr(i, 5)=='table' && line!=-1 && col!=-1) { //   table's tag
                    // Provide the reading of table's tag balise twice
                    while(text[i]!=">"){
                        i++;
                    }
                    i++;

                    table[line][col]=Array();
                    table[line][col]=table_text(text.slice(i), table[line][col]);

                    // Provide the reading of /table's tag twice
                    while(text.substr(i, 6)!='/table'){
                        i++;
                    }
                    i++;
                } else if(text.substr(i, 6)=='/table') { //   /table's tag
                    return table;
                }
            } 
        } else if(text[i]=="\n") { //    /n's tag
        } else if(text.substr(i, 4)=="    ") { //   tab's tag
            i+=3;
        } else { //Fill the table variable whith the text
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
    // Get the height of a line.
    // letter : (char).
    // Return 4 (int).

    return 4;
}

function letter_w(letter){
    // Get the width of a letter.
    // letter : (char).
    // Return the width of a letter (int).

    if(typeof(letter)=='string'){
        if(letter=='M'){
            return 4;
        } else if(letter=='@') {
            return 3.8;
        } else if(letter=='m'){
            return 3.1;
        } else if (letter=='S' || letter=='F'){
            return 2.2;
        } else if(letter=='f' || letter=='e'){
            return 1.7;
        } else if(letter=='-' || letter=='r' || letter=='s'){
            return 1.5;
        } else if(letter=='t'){
            return 1.2;
        } else if(letter=='i' || letter=='l' || letter=='.' || letter==' ' || letter=='r'){
            return 1;
        } else if(letter==letter.toUpperCase()){
            return 3;
        } else {
            return 2;
        }
    }
    return 2;
}

function max_col(table){
    // Get the maximum of word's lenght in each column of table variable.
    // table :(array) containing array or string.
    // Return the maximum of word's lenght in each column of table variable (array).

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

                //Check if the new word's width is superior at the last one
                if(width>max[j]){
                    max[j]=width;
                }
            }
        }
    }
    return max;
}

function place_table_in_PDF(pdf, table, start_h, start_w){
    // Write in a pdf file a given text.
    // pdf : (jsPDF) the file where to write.
    // table : (array) the text to write.
    // start_h : (int) the y coordonate in the pdf file.
    // start_w : (int) the x coordonate in the pdf file.
    // Return the final y coordonate  in the pdf file (int).

    // Add the text of chosen references to the PDF file
    let max_l_col=max_col(table);
    let line=start_h;
    let col=start_w;
    let col_w=0;
    for(let i=0; i<table.length; i++){
        for(let j=0; j<table[i].length; j++){

            //There's a table in the table
            if(typeof(table[i][j][0])=="object"){
                line+=letter_h("");
                line=place_table_in_PDF(pdf, table[i][j], line, col);

            //Write the letters
            } else {
                for(let k=0; k<table[i][j].length; k++){
                    pdf.fromHTML(table[i][j][k], col+col_w, line);
                    col_w+=letter_w(table[i][j][k]);
                }
            }

            //Change the coordinates
            col+=max_l_col[j]+2;
            col_w=0;
        }

        //Change the coordinates
        line+=letter_h("");
        col=start_w;
    }
    return line;
}

function create_PDF(){
    // Create a pdf file and fill it with the chosen references.

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

    //The coordinate in the pdf file of the text
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