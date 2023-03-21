function maakDeck() {
    var Suits = ['Heart', 'Diamond', 'Club', 'Spade'];
    var Values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'A', 'J', 'Q', 'K', 'Joker'];
    var Jokers = ['Black', 'Red', 'Black-hy'];

    // maakt een lege variable deck en een counter om bij te houden op wlke plek je in het deck zit.
    var deck = [];
    var cardcount = 0;

    // gaat elke waarde van kaarten langs(1,2,3,...A, Joker)
    for (var i = 0; i < Values.length;) {
        // Als de waarde geen joker is, koppel de waarde aan schoppen, harten, klaver en ruiten.
        if (Values[i] != 'Joker') {
            for (var j = 0; j < Suits.length;) {
                deck[cardcount] = '<img src="cards/Cards-' + Values[i] + '-' + Suits[j] + '.svg"></img>';
                cardcount++
                j++
            }
        }
        // Als de waarde een joker is koppel het aan zwart, rood of zwart leeg
        else {
            for (var k = 0; k < Jokers.length;) {
                deck[cardcount] = '<img src="cards/Cards-' + Values[i] + '-' + Jokers[k] + '.svg"></img>';
                cardcount++
                k++
            }
        }
        i++
    }
    return deck;
}

function deelKaarten() {
    // haalt het aantal spelers uit invoerveld en zet het om naar een getal.
    let spelers = parseInt(document.getElementById('spelers').value);

    var speler = [], sets = [];

    // zet alle sets van de spelers naar "", anders geven ze undefined aan.
    for (p = 0; p < (spelers); p++) {
        sets[p] = "";
    }

    // roept maakDeck aan
    var deck = maakDeck();

    // berekend het aantal kaarten per speler
    var maxkaarten = Math.floor(deck.length / spelers)

    // 
    var perspeler = document.getElementById('kaarten').value;
    if(perspeler > maxkaarten){
        document.getElementById('output').innerHTML = 'max aantal kaarten per speler = ' + maxkaarten;
        return
    }
    if(!perspeler){
        perspeler = maxkaarten;
    }

    // gaat elke speler langs
    for (i = 0; i < spelers;) {
        // deelt het aantal kaarten dat elke speler moet hebben uit per speler
        for (j = 1; j <= perspeler;) {
            var randomkaart = Math.floor(Math.random() * 55);
            if (deck[randomkaart]) {
                // als de speler nog geen kaarten heeft, zet, anders voeg toe.
                if (speler[i] == undefined) {
                    speler[i] = deck[randomkaart]
                } else {
                    speler[i] += deck[randomkaart];
                }
                deck[randomkaart] = null;
            }
            else {
                j--;
            }
            j++;
        }
        // zet alle spelers van de kaarten in sets. als 
        if (i == 0) {
            sets[i] = 'speler' + (i + 1) + ' ' + speler[i] + '<br>';
        }
        else {
            sets[i] += 'speler' + (i + 1) + ' ' + speler[i] + '<br>';
        }
        i++
    }

    // maakt een variable aan voor de overgebleven kaarten maakt deze leeg.
    var rest = "";

    // zet alle overgebleven kaarten in rest.
    (deck.forEach(element => {
        if (element == null) { }
        else { rest += element; }
    }))

    // als er overgebleven kaarten zijn, worden deze in de laatste set gezet.
    if (rest) {
        sets[spelers] = 'rest' + rest;
    }
    
    return sets;
}

function toonSets() {
    var sets = deelKaarten();
    if(sets){
        document.getElementById('output').innerHTML = "";
        sets.forEach(element => {
            document.getElementById('output').innerHTML += element + '<br>'
        });
    }
}