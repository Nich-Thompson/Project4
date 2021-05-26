let data = window.myArray[0];
let inputFields = window.myArray[1];
let tempInputFields = {};
const inputFieldBox = document.getElementById('input-field-box');

window.addEventListener('load', (e) => {
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

    const input = document.createElement('input');
    input.className = 'form-control';
    input.type = inputField.type;
    input.id = id;
    input.name = id;

    tempInputFields[id] = {label: inputField.label, type: inputField.type};

    formGroup.append(label, input);
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
            let position = document.createElement("td");
            let brand = document.createElement("td");
            let fabrication_year = document.createElement("td");
            let floor = document.createElement("td");
            let blusstof = document.createElement("td");
            let lastchecked = document.createElement("td");
            let location = document.createElement("td");
            let type = document.createElement("td");
            let debiet = document.createElement("td");
            let comments = document.createElement("td");
            let approved = document.createElement("td");

            position.textContent = element.position;
            brand.textContent = element.brand;
            fabrication_year.textContent = element.fabrication_year;
            floor.textContent = element.floor;
            blusstof.textContent = element.blusstof;
            lastchecked.textContent = element.lastchecked;
            location.textContent = element.location;
            type.textContent = element.type;
            debiet.textContent = element.debiet;
            comments.textContent = element.comments;

            if (element.approved === true) {
                approved.textContent = "Ja";
                approved.className = "text-success font-weight-bold";
            } else {
                approved.textContent = "Nee";
                approved.className = "text-danger font-weight-bold";
            }

            tr.append(position, brand, fabrication_year, floor, blusstof, lastchecked, location, type,
                debiet, comments, approved);

            div.appendChild(tr);
        })
    }
}


document.getElementById("form").addEventListener("submit", function (event) {
    event.preventDefault();
    let object = {};
    for (const [key, value] of Object.entries(tempInputFields)) {
        const input = document.getElementById(key);
        object[value.label] = input.value;
        if(value.type === 'checkbox'){
            input.value = false;
        }else{
            input.value = '';
        }
    }
    object['approved'] = document.getElementById('approved').value;

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
