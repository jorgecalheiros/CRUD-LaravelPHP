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
function show_card_delete(btn) {
    let cancel = document.getElementById("btn-cancel");
    let div = document.getElementById("modal-id");

    btn.addEventListener("click", function () {
        div.style.opacity = 1
        div.style.pointerEvents = "all";
    })

    cancel.addEventListener("click", function () {
        div.style.opacity = 0;
        div.style.pointerEvents = "none";
    })
}
confirm();

function show_card_delete_post() {
    let btn = document.getElementById("btn-delete-post");;
    if (btn) {
        show_card_delete(btn);
    }
}
function show_card_delete_user() {
    let btn = document.getElementById("btn-delete-user");
    let cancel = document.getElementById("btn-cancel");

    if (btn) {
        show_card_delete(btn);
    }
}
show_card_delete_post();
show_card_delete_user();
