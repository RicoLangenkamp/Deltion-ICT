var generated = [0, 0] //board, pieces
var rows = ["A", "B", "C", "D", "E", "F", "G", "H"]
function genBoard(a) {
    var board = document.getElementById("board");
    if (generated[0] == 0) {
        board.style.border = "1px solid black"
        var tiles = [...Array(8)].map(e => Array(8));
        var j, k = 1, y = Boolean(false);
        var rc = 0, cc = 0; // rowcount, columncount
        tiles.forEach(element => {
            let x = "";
            x += `<dl id="${8 - rc}"><div class="rows">${8 - rc}</div>`;
            cc = 0;
            for (i = 1; i <= 8;) {
                if (y == true) {
                    j = "black";
                } else {
                    j = "white";
                }
                x += `<dt id="${rows[cc] + (8-rc)}" class="${j}"></dt>`;
                k++, y = !y, cc++; 
                i++
            }
            x += "</dl>";
            board.innerHTML += x;
            y = !y; rc++;
        });
        x = "";
        x += `<dl>`;
        for (i = 0; i <= 7;) {
            x += `<dt class="columns">${rows[i]}</dt>`;
            i++
        }
        x += "</dl>";
        board.innerHTML += x;
        generated[0] = 1;
    }
    if(a == 1){
        genPieces();
    }
}

var pieces = [[8,"black_rook.png","black_knight.png","black_bishop.png","black_queen.png","black_king.png","black_bishop.png","black_knight.png","black_rook.png"]
            ,[7,"black_pawn.png","black_pawn.png","black_pawn.png","black_pawn.png","black_pawn.png","black_pawn.png","black_pawn.png","black_pawn.png"]
            ,[2,"White_pawn.png","White_pawn.png","White_pawn.png","White_pawn.png","White_pawn.png","White_pawn.png","White_pawn.png","White_pawn.png"]
            ,[1,"White_rook.png","White_knight.png","White_bishop.png","White_queen.png","White_king.png","White_bishop.png","White_knight.png","White_rook.png"]]

function genPieces() {
    if (generated[0] == 1 && generated[1] == 0) {
        pPath = "..\\..\\3rd_party\\Chess_Pieces\\chess\\"
        pieces.forEach(element => {
            for(z=1;z<=8;){
                getId(rows[z-1] + element[0]).innerHTML = `<img src="${pPath + element[z]}"></img>`
            z++}
        });
    }
}

function getId(a) {
    return document.getElementById(a);
}