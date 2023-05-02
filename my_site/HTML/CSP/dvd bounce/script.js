var box;

var maxX=1200-50;
var maxY=600-25;

var speed = 5;
window.onload = start;

function start() {
    box = document.getElementById("box");
    box.posX = box.offsetLeft;
    box.posY = box.offsetTop;
    box.velX = speed/3;
    box.velY = speed;

    let interval = setInterval(moveBox, 33);
}


function moveBox() {

    box.posX += box.velX;
    box.posY += box.velY;

    if (box.posX <= 0||box.posX >= maxX) {
        box.velX *= -1;
        if(box.posX >= maxX){
            box.posX = maxX;
        }
        else{
            box.posX = 0;
        }
    }
    if (box.posY <= 0||box.posY >= maxY) {
        box.velY *= -1;
        if(box.posY >= maxY){
            box.posY = maxY;
        }
        else{
            box.posY = 0;
        }
    }

    box.style.left = box.posX + "px";
    box.style.top = box.posY + "px";
}
