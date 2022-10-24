function tableOpen(id) {
    var email = id + ' email';
    var employer = id + ' employer';
    var type = id + ' type';
    var icon = id + ' icon';

    var ema = document.getElementById(email);
    var emp = document.getElementById(employer);
    var typ = document.getElementById(type);
    var ico = document.getElementById(icon);

    if (ema.className === 'hiddenRow' && emp.className === 'hiddenRow' && typ.className === 'hiddenRow') {
        ema.className += ' open';
        emp.className += ' open';
        typ.className += ' open';
        ico.className += ' animate';
    } else {
        ema.className = 'hiddenRow';
        emp.className = 'hiddenRow';
        typ.className = 'hiddenRow';
        ico.className = 'fa-solid fa-chevron-down';
    }

    
}