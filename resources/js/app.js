const { slice, conforms } = require('lodash');

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

function back_to_page() {
    let btn = document.getElementById("back-to-page");

    if (btn) {
        btn.addEventListener("click", function () {
            window.history.back();
        })
    }
}

function input_phone_mask() {
    input = document.querySelector("input[name='phone']");

    if (input) {
        input.addEventListener('blur', function (e) {
            var x = e.target.value.replace(/\D/g, '').match(/(\d{2})(\d{4})(\d{4})/);
            e.target.value = '(' + x[1] + ') ' + x[2] + '-' + x[3];
        });
    }
}

function preview_img() {
    let input = document.querySelector("input[name='profile_picture']");

    if (input == null) {
        input = document.querySelector("input[name='post_picture']");
    }
    let img = document.getElementById("img-preview");

    if (input) {
        input.addEventListener("change", function () {
            let file = this.files[0];

            if (file) {
                let reader = new FileReader();

                reader.addEventListener("load", function () {
                    img.setAttribute("src", this.result);
                });

                reader.readAsDataURL(file);
            }
        })
    }
}

preview_img();
input_phone_mask();
show_card_delete_post();
show_card_delete_user();
back_to_page();
