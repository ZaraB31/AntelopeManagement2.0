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

function openEditUploadForm(formName, ID, Name, Description){
    var x = document.getElementById(formName);
    x.style.display = "block";
    var id = x.querySelector('#id');
    var name = x.querySelector('#name');
    var description = x.querySelector('#description');
    name.value = Name;
    id.value = ID;
    description.value = Description;
}

function openDeleteForm(formName, ID) {
    var x = document.getElementById(formName);
    x.style.display = "block";
    var id = x.querySelector('#id');
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