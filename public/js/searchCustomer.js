let searchInput;
let customerFields;

window.onload = function () {
    searchInput = document.getElementById('search');
    customerFields = document.querySelectorAll('[id=customer-field]');
};

function search(){
    if(customerFields.length !== 0 && searchInput.value.length !== 0){
        const filteredFields = getFilteredFields();
        showFilteredFields(filteredFields);
    }
    if(searchInput.value.length === 0){
        showFilteredFields(customerFields);
    }
}

function getFilteredFields(){
    let filteredFields = [];
    customerFields.forEach(customerFields => {
        if(check(customerFields)){
            filteredFields.push(customerFields);
        }
    });
    return filteredFields;
}

function check(customerFields){
    const nameField = customerFields.querySelector('[id=name]');
    const name = nameField.textContent.replace("Klant ", "");
    return name.toLowerCase()[0].includes(searchInput.value[0].toLowerCase()) && name.toLowerCase().includes(searchInput.value.toLowerCase());
}

function showFilteredFields(filteredFields){
    let customers = document.getElementById('customers');
    customers.innerHTML = null;
    if(filteredFields.length === 0){
        customers.innerHTML = ' <div class="mt-4 bg-white">\n' +
            '                            <p class="float-left h3">Geen klanten beschikbaar</p>\n' +
            '                        </div>';
        return;
    }
    filteredFields.forEach(filteredField => {
        customers.appendChild(filteredField);
    });
}
