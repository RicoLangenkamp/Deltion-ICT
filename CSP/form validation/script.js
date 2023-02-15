function keyUp(inp) {
    console.log("De waarde in " + inp.placeholder + " is: " + inp.value)
    if (inp.id == "vname" || inp.id == "lname") {
        if (inp.value.length > 1) {
            inp.style.backgroundColor = "#AAFFAA";
            document.getElementById("namef").innerHTML = "";
        }
        else {
            inp.style.backgroundColor = "#FFAAAA"
            document.getElementById("namef").innerHTML = (inp.placeholder + " moet minimaal 2 karakters bevatten.");
        }
    }
    if (inp.id == "street") {
        if (inp.value.length >= 1) {
            inp.style.backgroundColor = "#AAFFAA";
            document.getElementById("adressf").innerHTML = "";
        }
        else {
            inp.style.backgroundColor = "#FFAAAA"
            document.getElementById("adressf").innerHTML = (inp.placeholder + " moet ingevuld zijn.");
        }
    }
    if (inp.id == "housenumber") {
        a = parseInt(inp.value);
        if (Number.isInteger(a)) {
            inp.style.backgroundColor = "#AAFFAA";
            document.getElementById("adressf").innerHTML = "";
        }
        else {
            inp.style.backgroundColor = "#FFAAAA"
            document.getElementById("adressf").innerHTML = ("huisnummer moet een nummer zijn.");
        }
    }
    if (inp.id == "postcode") {
        re = /^[0-9]{4}[A-z]{2}$/
        OK = re.exec(inp.value);
        if (OK) {
            inp.style.backgroundColor = "#AAFFAA";
            document.getElementById("placef").innerHTML = ("")
        }
        else {
            inp.style.backgroundColor = "#FFAAAA"
            document.getElementById("placef").innerHTML = (inp.value + " is geen geldige postcode.")
        }
    }
    if (inp.id == "place") {
        if (inp.value.length > 1) {
            inp.style.backgroundColor = "#AAFFAA";
            document.getElementById("placef").innerHTML = "";
        }
        else {
            inp.style.backgroundColor = "#FFAAAA"
            document.getElementById("placef").innerHTML = (inp.placeholder + " moet minimaal 2 karakters bevatten.");
        }
    }
    if (inp.id == "number") {
        checknum = /^[0-9]{2}-[0-9]{8}$/
        OK = checknum.exec(inp.value);
        if (OK) {
            inp.style.backgroundColor = "#AAFFAA";
            document.getElementById("numf").innerHTML = ("")
        }
        else {
            if (inp.value == "") {
                inp.style.backgroundColor = "#FFFFFF";
                document.getElementById("numf").innerHTML = ("")
            }
            else {
                inp.style.backgroundColor = "#FFAAAA"
                document.getElementById("numf").innerHTML = (inp.value + " is geen geldig telefoonnummer.")
            }
        }
    }
    if (inp.id == "email") {
        checkmail = /^[A-z]{4}@[A-z]{5}$/
        OK = checkmail.exec(inp.value);
        if (OK) {
            inp.style.backgroundColor = "#AAFFAA";
            document.getElementById("mailf").innerHTML = ("")
        }
        else {
            inp.style.backgroundColor = "#FFAAAA"
            document.getElementById("mailf").innerHTML = (inp.value + " is geen geldig telefoonnummer.")
        }
    }
}