let heroesCount = 0;
let query = document.forms.search.query;
let heroes = document.querySelectorAll('.hero_icon input');

function enableHeroPicker(enabled) {
    for (let i = 0; i < heroes.length; i++) {
        heroes[i].checked = false;
    }
    document.forms.search.pick_heroes.disabled = !enabled;
}

query.onchange = function() {
    switch (query.value) {
        case 'stats':
        case 'topheroes':
            document.forms.search.pick_mode.disabled = false;
            enableHeroPicker(false);
            break;
        case 'heroes':
            document.forms.search.pick_mode.disabled = false;
            enableHeroPicker(true);
            break;
        default:
            document.forms.search.pick_mode.disabled = true;
            enableHeroPicker(false);
    }
}

let tag = document.forms.search.tag;
let ready = document.querySelector('#search_button input');

tag.oninput = function() {
    if (tag.checkValidity()) ready.disabled = false;
    else ready.disabled = true;
}
