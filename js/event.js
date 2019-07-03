let formulaire = document.querySelector(".calendar");
let newForm = document.querySelector(".new");
newForm.style.visibility = "hidden";
newForm.style.display = "none";

window.addEventListener("scroll", function () {
    let rect = formulaire.getBoundingClientRect();
    y = rect.top;
    if (y <= 0){
        formulaire.style.visibility = "hidden";
        newForm.style.visibility = "visible";
        newForm.style.display = "block";
        newForm.style.backgroundColor = "white";
        newForm.style.width = "100%";
        newForm.style.textAlign = "center";
        newForm.style.zIndex = "22";
        newForm.style.padding = "15px 0";
        newForm.style.position = "fixed";
        newForm.style.borderBottom = '3px solid';
        newForm.style.borderBottomColor = '#CA2D15';
    }
    else{
        formulaire.style.visibility = "visible";
        newForm.style.visibility = "hidden";
        newForm.style.display = "none"
    }
})


