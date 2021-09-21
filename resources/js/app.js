require('./bootstrap');

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
confirm();
