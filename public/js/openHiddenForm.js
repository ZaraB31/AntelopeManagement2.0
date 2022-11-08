function openForm(formName) {
    var x = document.getElementById(formName);
    x.style.display = "block";
}

function closeForm(formName) {
    var x = document.getElementById(formName);
    x.style.display = "none";
}

function openEditForm(formName, ID, Name){
    var x = document.getElementById(formName);
    x.style.display = "block";
    var id = x.querySelector('#id');
    var name = x.querySelector('#name');
    name.value = Name;
    id.value = ID;
}

function openError() {
    var error = document.getElementById("errorAlert");
    
    if (error.style.display = "block") {
        var form = error.parentElement;
        var container = form.parentElement;
        container.style.display = "block";
    }
}