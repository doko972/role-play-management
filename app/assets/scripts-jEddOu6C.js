window.addEventListener("DOMContentLoaded",e=>{l()});function l(){let e=10,i=0,o,n;document.querySelectorAll(".animate-text").forEach(function(t){o=t.textContent.trim(),t.textContent="",n=o.split(""),t.style.visibility="visible",n.forEach(function(a,c){setTimeout(function(){t.textContent+=a},i+e*c)}),i+=e*n.length})}
