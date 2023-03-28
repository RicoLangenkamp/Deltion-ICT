function smoothScroll(a){
    console.log("test")
    document.querySelector(a).scrollIntoView({
        behavior: 'smooth'
    });
}

function sendToPage(a){
   
        window.location = a;
        
}