import './../sass/styles.scss';
import '/js/toggleEdit.js';
import '/js/toggleEditForm.js';

"use strict";

window.addEventListener("DOMContentLoaded", () => {
    animate_text();
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