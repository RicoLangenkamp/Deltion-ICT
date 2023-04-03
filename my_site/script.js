function smoothScroll(a){
    console.log("test")
    document.querySelector(a).scrollIntoView({
        behavior: 'smooth'
    });
}

function sendToPage(a){
    if(a.includes(".html")){
        window.location = a;
    }
    else if(a.includes(".php")){
        window.location.href = "http://localhost/html/" + a;
    }
}