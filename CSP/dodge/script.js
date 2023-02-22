var box;

var bullet;
var maxX = 1200 - 50;
var maxY = 600 - 25;

var speed = 5;
window.onload = start;

function start() {
    box = document.getElementById("box");
    box.posX = box.offsetLeft;
    box.posY = box.offsetTop;
    box.velX = speed / 3;
    box.velY = speed;

    setInterval(moveBox, 33);
}

var timer = setInterval(bullettimer(a, 50),);

function spawnbullet(a) {
    bulletnum = a;
    bullet = document.getElementById("bullet" + a);
    bullettime = document.getElementById("bullettime" + a);
    rng = Math.floor(Math.random() * 590);
    console.log(rng);
    bullet.style.top = rng + "px";
    bullettime.style.top = rng + "px";
    bullettimer(a, 50);
    bullettime.style.display = "block";
}

function bullettimer(b, i) {
    if (i == 0) {
        bullettime.style.display = "none";
        movebullet(b);
    }
    else {
        bullettime = document.getElementById("bullettime" + b);
        bullettime.style.width = i + "px"
        i -= 1;
        setTimeout(()=> {
            bullettimer(b,i);
         }
         ,20);
    }
}

function movebullet(c){
    
}

function moveBox() {
    box.posY += box.velY;

    if (box.posY <= 0 || box.posY >= maxY) {
        box.velY *= -1;
        if (box.posY >= maxY) {
            box.posY = maxY;
        }
        else {
            box.posY = 0;
        }
    }

    box.style.left = box.posX + "px";
    box.style.top = box.posY + "px";
}