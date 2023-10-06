const carrousel = document.querySelectorAll(".carous_me");
const prev_btn = document.querySelector('.btn_left');
const next_btn = document.querySelector('.btn_right');

const dots = document.querySelectorAll('.dot');

let currentSlide = 0;
let auto_interval;
const slides = document.querySelectorAll('.grid_them');

function Affiche_slide(index) {
    slides.forEach((slide, i) => {
        if (i === index) {
            slide.classList.add("show"); 
        } else {
            slide.classList.remove("show"); 
        }
    });

    dots.forEach((dot_el, i) => {
        if (i === index) {
            dot_el.classList.add("active_dot");
        } else {
            dot_el.classList.remove("active_dot");
        }
    });
    
}

prev_btn.addEventListener("click", () => {
    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
    Affiche_slide(currentSlide);
});

next_btn.addEventListener("click", () => {
    currentSlide = (currentSlide + 1) % slides.length;
    Affiche_slide(currentSlide);
});

function automatique_next() {
    currentSlide = (currentSlide + 1) % slides.length;
    Affiche_slide(currentSlide);
}

auto_interval = setInterval(automatique_next, 5000); 

carrousel.forEach((carrousel_el) => {
    carrousel_el.addEventListener('mouseenter', () => {
        clearInterval(auto_interval);
    });

    carrousel_el.addEventListener('mouseleave', () => {
        auto_interval = setInterval(automatique_next, 5000); 
    });
});

Affiche_slide(currentSlide);


function selectTab(tabIndex) {
    var tabContents = document.querySelectorAll('.tabContent');
    tabContents.forEach(function (content) {
        content.style.display = 'none';
    });

    var selectedTabContent = document.getElementById('tab' + tabIndex + 'Content');
    if (selectedTabContent) {
        selectedTabContent.style.display = 'block';
    }
}
window.addEventListener('load', function () {
    selectTab(1);
});



function addthem(produitId) {
    // Effectuez une requête AJAX vers getproduct.php pour obtenir les détails du produit
    fetch('getproduct.php?id=' + produitId)
        .then(response => response.json())
        .then(detailsProduit => {
            console.log(detailsProduit); // Ajoutez cette ligne pour vérifier la réponse JSON
            // Une fois les détails du produit obtenus, appelez une fonction pour les afficher
            afficherProduitDansPanier(detailsProduit);
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des détails du produit :', error);
        });
}



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




