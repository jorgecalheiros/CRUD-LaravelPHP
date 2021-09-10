require('./bootstrap');

function show_info() {
    let btn = document.getElementById("btn-show-user");
    if (btn) {
        let content = document.getElementById("info");
        btn.addEventListener("click", function () {
            let i = btn.childNodes[1];
            if (i.className == "fas fa-eye-slash") {
                i.setAttribute("class", "fas fa-eye");
            } else {
                i.setAttribute("class", "fas fa-eye-slash");
            }
            if (content.className.indexOf(" hidden") != -1) {
                content.classList.remove("hidden");
            } else {
                content.classList.add("hidden");
            }
        })
    }
}
function confirm() {
    let btn = document.getElementById("excluir");

    if (btn) {
        let confirm = document.getElementById("confirm");
        let cacelar = document.getElementById("cacelar");
        let body = document.getElementById("false");
        btn.addEventListener("click", function () {
            if (confirm.style.opacity == 0) {
                body.style.display = "block";
                confirm.classList.add("show");
            } else {
                body.style.display = "none";
                confirm.classList.remove("show");
            }
        })
        cacelar.addEventListener("click", function () {

            body.style.display = "none";
            confirm.classList.remove("show");
        })
    }
}
show_info();
confirm();
