var panierButton = document.getElementById("panier_button");
var panierContent = document.getElementById("panier_content");

panierButton.addEventListener("click", function() {
    if (panierContent.style.display === "none" || panierContent.style.display === "") {
        panierContent.style.display = "block"; 
    } else {
        panierContent.style.display = "none"; 
    }
});

var profil_content = document.querySelector(".profil-container");
var profil_btn = document.querySelector(".logins");

profil_btn.addEventListener("click", function() {
    if (profil_content.style.display === "none" || profil_content.style.display === "") {
        profil_content.style.display = "block";
    } else {
        profil_content.style.display = "none";
    }
});
