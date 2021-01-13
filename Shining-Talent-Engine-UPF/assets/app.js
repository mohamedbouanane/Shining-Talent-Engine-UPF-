/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

function menuToggle(){
    if (document.getElementById("navBtn").className === "navOpen") {
        document.getElementById("navBtn").className = "";
        document.getElementById("listMenu").className = "";
        document.getElementById("shadowbox").className = "";
    } else {
        document.getElementById("navBtn").className = "navOpen";
        document.getElementById("listMenu").className = "listOpen";
        document.getElementById("shadowbox").className = "visible";
    }
}

function w3_open() {
    document.getElementById("mySidebar").style.width = "100%";
    document.getElementById("mySidebar").style.display = "block";
}

function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
}


