let aColor = ['red', 'lightblue', 'lime', 'purple', 'green', 'yellow', 'gray', 'turquoise', 'blue'];
let teller;

let raak = 0;
let mis = 0;
let laat = 0;

var interval;
let timer = 0;
var timer2;



function start() {
    if (!interval) {
        color();
        let tsec = document.getElementById("timet").value;
        let ksec = document.getElementById("timek").value;

        interval = window.setInterval(late, (ksec * 1000));
        timer2 = window.setInterval(time, (tsec * 1000));

        document.getElementById("testje").innerHTML = "";
        document.getElementById("raak").innerHTML = "<b>aantal raak is: </b>";
        document.getElementById("mis").innerHTML = "<b>aantal mis is: </b>";
        document.getElementById("laat").innerHTML = "<b>aantal laat is: </b>";
        document.getElementById("score").innerHTML = "<b>Je score is: </b>";

        raak = 0;
        mis = 0;
        laat = 0;
    } else { }
}

function time() {
    if (timer = 0) {
        timer++;
    }
    else if (timer = 1) {
        window.clearInterval(interval);
        interval = null;
        window.clearInterval(timer2);
        console.log("Timer ended");
        timer = 0;
        
        document.getElementById("testje").innerHTML += "Einde tijd";
        document.getElementById("score").innerHTML += (raak - mis - laat);
        document.getElementById("raak").innerHTML += raak;
        document.getElementById("mis").innerHTML += mis;
        document.getElementById("laat").innerHTML += laat;
    }
}

function stop() {
    if (!interval) {
    } else {
        window.clearInterval(interval);
        interval = null;
        time();
    }
}

function late() {
    color();
    document.getElementById("testje").innerHTML += "Laat <br>";
    laat++;
}

function doeIets(elm) {
    if (interval != null) {
        if (document.getElementById("div10").style.backgroundColor == document.getElementById("div" + elm).style.backgroundColor) {
            console.log("de kleur is gelijk");
            color();
            document.getElementById("testje").innerHTML += "Raak <br>";
            raak++;
            window.clearInterval(interval);
            interval = window.setInterval(late, 2000);
        } else {
            console.log("de kleur is NIET gelijk");
            color();
            document.getElementById("testje").innerHTML += "Mis <br>";
            mis++;
            window.clearInterval(interval);
            interval = window.setInterval(late, 2000);
        }
    }
}

function color() {
    aColor = shuffle(aColor);
    for (teller = 1; teller <= 9; teller = teller + 1) {

        var chosen = Math.round(Math.random() * 9);

        document.getElementById("div" + teller).style.backgroundColor = aColor[(teller - 1)];
        document.getElementById("div10").style.backgroundColor = aColor[chosen];
    }
}

function shuffle(a) {
    for (let i = a.length - 1; i > 0; i--) {
        let j = Math.floor(Math.random() * (i + 1));
        [a[i], a[j]] = [a[j], a[i]];
    }

    return a;
}