let data = window.myArray[0];
let inputFields = window.myArray[1];
let dynamicLists = window.myArray[2];
let tempInputFields = {};
const inputFieldBox = document.getElementById('input-field-box');
let id = 0;

window.addEventListener('load', (e) => {
    console.log(inputFields)
    console.log(dynamicLists);
    generateInputFields();
});

document.getElementById("offline").style.display = "none";

function generateInputFields() {
    inputFields.unshift({label: 'Pos.', type: 'text'});
    inputFields.push({label: 'Opmerkingen', type: 'text', isCommentsList: true});

    inputFields.forEach(inputField => {
        id++;
        generateInputField(inputField)
    });

    setJson();
}

function generateInputField(inputField) {
    const formGroup = document.createElement('div');
    formGroup.className = 'form-group pl-3 col-md-4';

    const label = document.createElement('label');
    label.className = 'mb-0';
    label.textContent = inputField.label;

    let itemsToAppend = [];

    if (inputField.type === 'select') {
        if (dynamicLists[inputField.list_id].values.length !== 0) {
            let length = dynamicLists[inputField.list_id].values[0].length;

            let copyId = id;
            let ids = [copyId];
            for(let i = 0; i < length; i++){
                ids.push(++copyId);
            }
            for (let i = 0; i < length; i++) {

                let list = dynamicLists[dynamicLists[inputField.list_id].values[0][i].id];
                if (i === 0) {
                    itemsToAppend.push(createListSelect(list, false));
                } else {
                    itemsToAppend.push(createListSelect(list, true));
                }
                id++;
            }
            if(itemsToAppend.length > 1){
                for(let x = 0; x < itemsToAppend.length-1; x++){
                    itemsToAppend[x].addEventListener('click', (e) =>{
                        e.preventDefault();
                        filterDynamicList(dynamicLists[dynamicLists[inputField.list_id].values[0][x+1].id],itemsToAppend[x+1].childNodes[1], itemsToAppend[x].childNodes[1].value);
                        let check = x+ 2;
                        while(check <= itemsToAppend.length-1){
                            itemsToAppend[check].childNodes[1].disabled = true;
                            Array.prototype.forEach.call(itemsToAppend[check].childNodes[1].options, o=> o.remove());
                            check++;
                        }
                    });
                }
            }
        }
    } else {
        const input = document.createElement('input');

        if (inputField.isCommentsList === true) {
            input.setAttribute('is-comment-input', 'true');
        }

        if (inputField.type === 'checkbox') {
            input.className = 'form-check';
        } else {
            input.className = 'form-control';
        }
        input.type = inputField.type;
        input.id = id;
        input.name = id;

        tempInputFields[id] = {label: inputField.label, type: inputField.type};

        formGroup.append(label, input);
    }

    if (formGroup.innerHTML) {
        inputFieldBox.append(formGroup);
    }

    itemsToAppend.forEach(i => {
        inputFieldBox.append(i);
    })
}

function createSelect(inputField, formGroup, label) {
    let select = document.createElement('select');
    select.className = 'form-select';
    select.id = id;
    select.name = id;

    //if is comment field
    if (inputField.isCommentsList === true) {
        select.setAttribute('is-comment', 'true');
        select.addEventListener("click", function () {
            document.querySelectorAll('[is-comment-input]')[0].value = select.value.toString();
        });
    }

    for (const [key, value] of Object.entries(dynamicLists[inputField.list_id].values)) {
        const option = document.createElement('option');
        option.value = value[0].value;
        option.textContent = value[0].value;
        select.append(option);
    }

    tempInputFields[id] = {label: inputField.label, type: inputField.type};

    formGroup.append(label, select);

    return select;
}

function createListSelect(list, disabled) {
    const formGroup = document.createElement('div');
    formGroup.className = 'form-group pl-3 col-md-4';

    const label = document.createElement('label');
    label.className = 'mb-0';
    label.textContent = list.name;

    let select = document.createElement('select');
    select.className = 'form-select';
    select.id = id;
    select.name = id;
    select.disabled = disabled;

    if (!disabled) {
        for (const [key, value] of Object.entries(list.values)) {
            const option = document.createElement('option');
            option.value = value[value.length - 1].value;
            option.textContent = value[value.length - 1].value;
            select.append(option);
        }
    }

    tempInputFields[id] = {label: list.name, type: "select"};

    formGroup.append(label, select);

    return formGroup;
}

function filterDynamicList(list, select, selected_value) {
    select.disabled = false;
        Array.prototype.forEach.call(select.options, o=> o.remove());
    getValuesForSelect(list, selected_value).forEach(value => {
        const option = document.createElement('option');
        option.value = value;
        option.textContent = value;
        select.append(option);
    });
}

function getValuesForSelect(list, selected_value){
    let values = [];
    for (const [key, value] of Object.entries(list.values)) {
        if(value[value.length-2].value === selected_value){
            values.push(value[value.length-1].value)
        }
    }
    return values;
}

function setJson() {
    if (data.json === "") {
        localStorage.setItem("inspections", JSON.stringify([]));
        document.getElementById("1").value = 1;
    } else {
        localStorage.setItem("inspections", data.json);
        renderData();
    }
}


function renderData() {
    if (localStorage.getItem("inspections") !== null && localStorage.getItem("inspections") !== "") {
        let inspections = JSON.parse(localStorage.getItem("inspections"));
        document.getElementById("1").value = inspections.length + 1;
        let div = document.getElementById("inspections");

        div.innerHTML = "";

        if (!(inspections instanceof Array))
            inspections = [inspections];


        inspections.forEach(element => {
            let tr = document.createElement("tr");
            for (const [key, value] of Object.entries(element)) {
                const td = document.createElement("td");
                if (value.value === true) {
                    td.textContent = "Ja";
                    td.className = "text-success font-weight-bold";
                } else if (value.value === false) {
                    td.textContent = "Nee";
                    td.className = "text-danger font-weight-bold";
                } else if (value.type === 'datetime-local') {
                    if (value.value) {
                        td.textContent = new Date(value.value).toLocaleString([], {
                            day: '2-digit',
                            month: '2-digit',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                    } else {
                        td.textContent = "";
                    }
                } else {
                    td.textContent = value.value;
                }
                tr.append(td);
            }

            div.appendChild(tr);
        })
    }
}

//submit form items
document.getElementById("form").addEventListener("submit", function (event) {
    event.preventDefault();
    let object = {};
    for (const [key, value] of Object.entries(tempInputFields)) {
        const input = document.getElementById(key);

        if (!input.getAttribute('is-comment')) {
            object[input.id] = {type: value.type, value: input.value};
        }

        if (value.type === 'checkbox') {
            object[input.id] = {type: value.type, value: input.checked};
            input.checked = false;
        } else if (value.type !== 'select') {
            input.value = '';
        }
        // else {
        //     input.childNodes[0].selected = true;
        // }
    }
    const input = document.getElementById('approved');
    object[input.id] = {type: 'checkbox', value: input.checked};
    document.getElementById('approved').checked = true;

    saveNewObject(object);
    renderData();
});

function saveNewObject(object) {
    let storage = JSON.parse(localStorage.getItem("inspections"));

    if (!(storage instanceof Array))
        storage = [storage];
    storage.push(object);

    localStorage.setItem("inspections", JSON.stringify(storage));

    syncData();
}

function syncData() {
    fetch("/inspection/save/" + data.id, {
        method: "POST",
        "Content-type": "application/json",
        body: JSON.stringify({json: localStorage.getItem("inspections")})
    }).then(res => {
        console.log("Request complete! Data saved in database!");
    }).catch(err => console.log(err));
}

window.addEventListener('online', () => {
    document.getElementById("offline").style.display = "none";
    syncData();
});
window.addEventListener('offline', () => {
    document.getElementById("offline").style.display = "block";
});
