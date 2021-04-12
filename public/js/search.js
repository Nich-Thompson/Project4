let searchInput;
let inspectorFields;

window.onload = function () {
    searchInput = document.getElementById('search');
    searchInput.addEventListener('keyup',(e) => {
        search();
    });
    document.getElementById('searchBtn').addEventListener('click', (e) => {
        e.preventDefault();
        search();
    })
    inspectorFields = document.querySelectorAll('[id=inspector-field]');
};

function search(){
    if(inspectorFields.length !== 0 && searchInput.value.length !== 0){
        const filteredFields = getFilteredFields();
        showFilteredFields(filteredFields);
    }
    if(searchInput.value.length === 0){
        showFilteredFields(inspectorFields);
    }
}

function getFilteredFields(){
    let filteredFields = [];
    inspectorFields.forEach(inspectorField => {
        if(check(inspectorField)){
            filteredFields.push(inspectorField);
        }
    });
    return filteredFields;
}

function check(inspectorField){
    const nameField = inspectorField.querySelector('[id=name]');
    const name = nameField.textContent.replace("Inspecteur ", "");
    return name.toLowerCase().includes(searchInput.value.toLowerCase());
}

function showFilteredFields(filteredFields){
    let inspectors = document.getElementById('inspector');
    inspectors.innerHTML = null;
    if(filteredFields.length === 0){
        inspectors.innerHTML = ' <div class="mt-4 bg-white">\n' +
            '                            <p class="float-left h3">Geen inspecteurs beschikbaar</p>\n' +
            '                        </div>';
        return;
    }
    filteredFields.forEach(filteredField => {
        inspectors.appendChild(filteredField);
    });
}
