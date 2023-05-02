function maakDeck(a) {
    var Suits = ['Heart', 'Diamond', 'Club', 'Spade'];
    var Values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'A', 'J', 'Q', 'K', 'Joker'];
    var Jokers = ['Black', 'Red', 'Black-hy'];

    // maakt een lege variable deck en een counter om bij te houden op wlke plek je in het deck zit.
    var deck = [];
    var cardcount = 0;
    var incjokers = document.getElementById("jokers").checked;
    // maakt het aantal decks aan dat er gevraagd is.
    for (t = 1; t <= a;) {
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
                // kijkt of de checkbox 'zonder jokers' aan staat, dan sla de jokers over.
                if (incjokers == false) {
                    for (var k = 0; k < Jokers.length;) {
                        deck[cardcount] = '<img src="cards/Cards-' + Values[i] + '-' + Jokers[k] + '.svg"></img>';
                        cardcount++
                        k++
                    }
                }
            }
            i++
        }
        t++
    }
    return deck;
}

function deelKaarten() {
    // haalt het aantal spelers uit invoerveld en zet het om naar een getal.
    let spelers = parseInt(document.getElementById('spelers').value);

    var speler = [], sets = [];

    // haalt het aantal stapels kaarten uit ingevoerd veld (standaard 1) en zet het om naar een getal.
    var aantal = parseInt(document.getElementById('stapels').value);

    // zet alle sets van de spelers naar "", anders geven ze undefined aan.
    for (p = 0; p < (spelers); p++) {
        sets[p] = "";
    }

    // roept maakDeck aan er geeft een parameter mee om aan te geven hoeveel decks hij wil hebben
    var deck = maakDeck(aantal);
    // berekend het aantal kaarten per speler
    var maxkaarten = Math.floor(deck.length / spelers)

    // kijkt of het aantal kaarten per speler dat ingevuld is mogelijk is.
    var perspeler = document.getElementById('kaarten').value;
    if (perspeler > maxkaarten) {
        document.getElementById('output').innerHTML = 'max aantal kaarten per speler = ' + maxkaarten + ', of min aantal stapels = ' + (Math.ceil(spelers * perspeler/55));
        return
    }
    // kijkt of aantal kaarten per speler veld leeg is, als dit zo is gebruik max aantal kaarten per speler.
    if (!perspeler) {
        perspeler = maxkaarten;
    }
    // als het aantal spelers meer is dan het aantal kaarten in het deck, geeft hij aan hoeveel spelers de max is.
    if (spelers > deck.length) {
        document.getElementById('output').innerHTML = 'max aantal spelers = ' + deck.length + ', of min aantal stapels = ' + (Math.ceil(spelers/55));
        return
    }

    // gaat elke speler langs
    for (i = 0; i < spelers;) {
        // deelt het aantal kaarten dat elke speler moet hebben uit per speler
        for (j = 1; j <= perspeler;) {
            var randomkaart = Math.floor(Math.random() * deck.length);
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
    if (sets) {
        document.getElementById('output').innerHTML = "";
        sets.forEach(element => {
            document.getElementById('output').innerHTML += element + '<br>'
        });
    }
}

window.addEventListener('keydown', function(e) {
    if(e.keyCode == 32 && e.target == document.body) {
      e.preventDefault();
      toonSets();
    }
  });
  
function back(){
    window.history.back();
}