function showstaffsign() {
    document.querySelector('.staff--signup').classList.toggle('hidden');
}

function showupload() {
    document.querySelector('.uploadpro').classList.toggle('hidden');
}

function show_instagram() {
    document.querySelector('.show_instagram').classList.toggle('hidden');
}

var updateForm = document.getElementById("update-form");
var editClose = document.getElementById("edit-close");

if (updateForm) {
  editClose.onclick = function () {
    updateForm.classList.add("x-hide-display");
    updateForm.classList.remove("x-display");
  }
}