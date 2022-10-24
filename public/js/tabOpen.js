function openCompany(evt, companyName) {
    var i, tabContent, tabLink;
    tabContent = document.getElementsByClassName("tabContent");
    for (i = 0; i < tabContent.length; i++) {
      tabContent[i].style.display = "none";
    }
    tabLink = document.getElementsByClassName("tabLink");
    for (i = 0; i < tabLink.length; i++) {
      tabLink[i].className = tabLink[i].className.replace(" active", "");
    }
    document.getElementById(companyName).style.display = "grid";
    evt.currentTarget.className += " active";
}

function open() {
    var tabLinks = document.getElementsByClassName("tabLink");
    tabLinks[0].click();
}