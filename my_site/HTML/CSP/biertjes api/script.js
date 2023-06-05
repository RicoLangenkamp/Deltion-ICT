// url van API, in dit geval van 750 belgische biertjes
// wil je een ander API gebruiken?
//  - verander de url
//  - pas in regels 72 en 73 de namen  van de object-keys aan
var url  = "https://15euros.nl/api/bier_basic.php";
// 4)  AJAX call met Axios library, heeft include van Axios library nodig
function fLaadBier_axios() {
    axios.get(url)
        .then(function (response) {
            //console.log("\"response\" van Axios get-request: ", response); //hele response, bekijk hem: er staat meer dan alleen de data in
            let json = response.data; // de eigenschap "data" van het object "response" bevat de gevraagde json
            //console.log("Bier, geladen met AJAX via Axios ", json);
            fJson2Html(json); // geef JSON en title door aan function
        })
}

// Na het ophalen van de JSON uit de API, wordt steeds onderstaande function aangeroepen
// die de JSON naar HTML vertaald en in "out_data" zet
function fJson2Html(json) {

    var table = "<table>";
    table += "<tr>";
        table += "<th>";
            table += "nr";
        table += "</th>";
        table += "<th>";
            table += "naam";
        table += "</th>";
        table += "<th>";
            table += "brouwer";
        table += "</th>";
        table += "<th>";
            table += "Type";
        table += "</th>";
        table += "<th>";
            table += "Gisting";
        table += "</th>";
    table += "</tr>";
    for(var i=0; i<json.length; i++) {
        table += "<tr>";
            table += "<td>" + (i+1) + "</td>";              // zet een volgorde nummer voor in de rij
            table += "<td>" + json[i].naam + "</td>";       // haal van de array nr i van de json, de object key "naam" op
            table += "<td>" + json[i].brouwer + "</td>";    // haal van de array nr i van de json, de object key "brouwer" op
            table += "<td>" + json[i].type + "</td>";       // haal van de array nr i van de json, de object key "type" op
            table += "<td>" + json[i].gisting + "</td>";    // haal van de array nr i van de json, de object key "gisting" op
        table += "</tr>";
    }
    table += "</table>";

    document.getElementById("table").innerHTML = table; // vul "out_data" met de uit de json opgebouwe table
}
