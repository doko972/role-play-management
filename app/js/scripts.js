import './../sass/styles.scss';
import '/js/toggleEdit.js';
import '/js/toggleEditForm.js';

"use strict";

window.addEventListener("DOMContentLoaded", () => {
    animate_text();
    setupFormValidation();
});

function animate_text() {
    let delay = 10,
        delay_start = 0,
        contents,
        letters;

    document.querySelectorAll(".animate-text").forEach((elem) => {
        contents = elem.textContent.trim();
        elem.textContent = "";
        letters = contents.split("");
        elem.style.visibility = 'visible';

        letters.forEach((letter, index) => {
            setTimeout(() => {
                elem.textContent += letter;
            }, delay_start + delay * index);
        });
        delay_start += delay * letters.length;
    });
}

function setupFormValidation() {
    const form = document.querySelector('form.login_cont');
    if (form) {
        form.addEventListener('submit', function(event) {
            if (!validateForm()) {
                event.preventDefault();
            }
        });
    }
}

function validateForm() {
    const password = document.getElementById("password");
    const repassword = document.getElementById("repassword");
    const birthday = document.getElementById("user_birthday");

    if (!password || !repassword || !birthday) {
        console.error("Un ou plusieurs éléments du formulaire sont manquants");
        return false;
    }

    if (password.value !== repassword.value) {
        alert("Les mots de passe ne correspondent pas.");
        return false;
    }

    const birthdayDate = new Date(birthday.value);
    const today = new Date();
    let age = today.getFullYear() - birthdayDate.getFullYear();
    const m = today.getMonth() - birthdayDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthdayDate.getDate())) {
        age--;
    }

    if (age < 13) {
        alert("Vous devez avoir au moins 13 ans pour vous inscrire.");
        return false;
    }

    return true;
}