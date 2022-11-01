function openForm(formName) {
    var x = document.getElementById(formName);
    x.style.display = "block";
}

function closeForm(formName) {
    var x = document.getElementById(formName);
    x.style.display = "none";
}

function openError() {
    var error = document.getElementById("errorAlert");
    
    if (error.style.display = "block") {
        var form = error.parentElement;
        var container = form.parentElement;
        container.style.display = "block";
    }
}