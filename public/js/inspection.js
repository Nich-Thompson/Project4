let data = window.myArray[0];
let inputFields = window.myArray[1];
let dynamicLists = window.myArray[2];
let tempInputFields = {};
const inputFieldBox = document.getElementById('input-field-box');

window.addEventListener('load', (e) => {
    console.log(dynamicLists);
    generateInputFields();
});

document.getElementById("offline").style.display = "none";

function generateInputFields(){
    let id = 1;
    inputFields.unshift({label:'Pos.', type: 'number'});
    inputFields.push({label:'Opmerkingen', type: 'text'});
    inputFields.forEach(inputField => {
        generateInputField(inputField, id)
        id++;
    });
    setJson();
}

function generateInputField(inputField, id){
    const formGroup = document.createElement('div');
    formGroup.className = 'form-group pl-3 col-md-4';

    const label = document.createElement('label');
    label.className = 'mb-0';
    label.textContent = inputField.label;

    if(inputField.type === 'select'){
        let select = document.createElement('select');
        select.className = 'form-select';
        select.id = id;
        select.name = id;
        for (const [key, value] of Object.entries(dynamicLists[inputField.list_id].values)) {
            const option = document.createElement('option');
            option.value = value[0].value;
            option.textContent = value[0].value;
            select.append(option);
        }

        tempInputFields[id] = {label: inputField.label, type: inputField.type};

        formGroup.append(label, select);
    }else{
        const input = document.createElement('input');
        if(inputField.type === 'checkbox'){
            input.className = 'form-check';
        }else{
            input.className = 'form-control';
        }
        input.type = inputField.type;
        input.id = id;
        input.name = id;

        tempInputFields[id] = {label: inputField.label, type: inputField.type};

        formGroup.append(label, input);
    }

    inputFieldBox.append(formGroup);
}

function setJson(){
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
                } else if (value.value === false){
                    td.textContent = "Nee";
                    td.className = "text-danger font-weight-bold";
                }else if(value.type === 'datetime-local'){
                    td.textContent = new Date(value.value).toLocaleString();
                }else{
                    td.textContent = value.value;
                }
                tr.append(td);
            }

            div.appendChild(tr);
        })
    }
}


document.getElementById("form").addEventListener("submit", function (event) {
    event.preventDefault();
    let object = {};
    for (const [key, value] of Object.entries(tempInputFields)) {
        const input = document.getElementById(key);
        object[value.label] = {type: value.type, value:input.value};
        if(value.type === 'checkbox'){
            object[value.label] = {type: value.type, value:input.checked};
            input.checked = false;
        }else if(value.type !== 'select'){
            input.value = '';
        }else{
            input.childNodes[0].selected = true;
        }
    }
    object['approved'] = {type: 'checkbox', value:document.getElementById('approved').checked};
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
