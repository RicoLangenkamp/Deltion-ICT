var player;
let score = 0;
var gameover = Boolean(false);

var bullet;
var maxX = 1200;
var maxY = 600;
var bullettime = [document.getElementById('bullettime0'), document.getElementById('bullettime1'), document.getElementById('bullettime2'), document.getElementById('bullettime3'), document.getElementById('bullettime4'), document.getElementById('bullettime5')];
var bullet = [document.getElementById('bullet0'), document.getElementById('bullet1'), document.getElementById('bullet2'), document.getElementById('bullet3'), document.getElementById('bullet4'), document.getElementById('bullet5')];

var speed = 5;
var count = 5;
var misses = 0;

document.onkeydown = function (e) {
    if(gameover == false){
        switch (e.keyCode) {
            case 38:
                movePlayer('up')
                break
            case 40:
                movePlayer('down')
                break
        }
    }
}

let starting = setInterval(startFire, 2000);
window.onload = start;

for (i = 0; i < 5;) {
    bullet[i].posX = bullet[i].offsetLeft;
    i++
}

function start() {
    player = document.getElementById("player");
    player.posY = player.offsetTop;
}

function startFire() {
    spawnBullet(5 - count);
    count -= 1;
    if (count == 0) {
        clearInterval(starting);
    }
}


function spawnBullet(a) {
    if(gameover == false){
        rng = Math.floor(Math.random() * 590);
        bullet[a].style.top = rng + "px";
        bullettime[a].style.top = rng + 10 + "px";
        bullettime[a].style.display = "block";
        bullettimer(a, 50);

        bullet[a].posY = rng;
    }
}

function bullettimer(b, i) {
    if(gameover == false){
        if (b < 0) { return; }
        else {
            if (i == 0) {
                bullettime[b].style.display = "none";
                movebullet(b);
            }
            else {
                bullettime[b].style.width = i + "px";
                i -= 1;
                setTimeout(() => { bullettimer(b, i); }, 20);
            }
        }
    }
}

function movebullet(c) {
    if(gameover == false){
        bullet[c].posX += speed;
        bullet[c].style.left = bullet[c].posX + "px";
        if (bullet[c].posY >= player.posY - 10 && bullet[c].posY <= player.posY + 50 && bullet[c].posX >= maxX - 30) {
            score += 1;
            document.getElementById("score").innerHTML = "jouw score is: " + score;
            bullet[c].style.left = "0px";
            bullet[c].posX = 0;
            spawnBullet(c);
        }
        else if (bullet[c].posX >= maxX - 25) {
            bullet[c].style.left = "0px";
            bullet[c].posX = 0;
            spawnBullet(c);
            misses++;
            document.getElementById("mis").innerHTML += " x";
            if (misses == 5) {
                gameOver()
            }
        }
        else {
            setTimeout(() => { movebullet(c) }, 33);
        }
    }
}


function movePlayer(a) {
    if (a == 'up') {
        if (player.posY <= 0) { }
        else { player.posY -= speed * 3 }
    }
    if (a == 'down') {
        if (player.posY >= maxY - 50) { }
        else { player.posY += speed * 3 }
    }
    if (player.posY < 0) { player.posY = 0 }
    if (player.posY > maxY - 50) { player.posY = maxY - 50 }
    player.style.top = player.posY + "px";
}

function gameOver() {
    console.log("game over");
    gameover = true;
    document.getElementById("dialog").style.top = "200px";
    document.getElementById("overlay").style.display = "block";
    document.getElementById("dialogcontent").innerHTML += score ;
}

function reset(){
    location.reload();
}