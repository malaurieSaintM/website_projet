let coll = document.getElementsByClassName("otherColl");
let i;

for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        console.log(this)
        let contentColl = this.nextElementSibling;
        if (contentColl.style.maxHeight){
            contentColl.style.maxHeight = null;
        } else {
            contentColl.style.maxHeight = contentColl.scrollHeight + "px";
        }
    });
}