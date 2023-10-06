
document.addEventListener("DOMContentLoaded", function() {
  // Votre code JavaScript ici


const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

/*signUpButton.addEventListener('click', () => {
  container.classList.add("right-panel-active");
});
*/
/*signInButton.addEventListener('click', () => {
  container.classList.remove("right-panel-active");
});*/





var admin_btn = document.querySelector(".add_admin");
var overlay_content = document.querySelector(".overlay");

admin_btn.addEventListener("click", function() {
    console.log("Bouton cliqué.");
    if (overlay_content.classList.contains("show_admin")) {
        overlay_content.classList.remove("show_admin");
    } else {
        overlay_content.classList.add("show_admin");
    }
});

});



