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
    inputFields.push({label: 'Goedgekeurd', type: 'checkbox', default: true});

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
        if (dynamicLists[inputField.list_id].values.length !== 0 && dynamicLists[inputField.list_id].values[0].length > 1) {
            let length = dynamicLists[inputField.list_id].values[0].length;

            let copyId = id;
            let ids = [copyId];
            for (let i = 0; i < length; i++) {
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
            if (itemsToAppend.length > 1) {
                for (let x = 0; x < itemsToAppend.length - 1; x++) {
                    itemsToAppend[x].addEventListener('click', (e) => {
                        e.preventDefault();
                        filterDynamicList(dynamicLists[dynamicLists[inputField.list_id].values[0][x + 1].id], itemsToAppend[x + 1].childNodes[1], itemsToAppend[x].childNodes[1].value);
                        let check = x + 2;
                        while (check <= itemsToAppend.length - 1) {
                            itemsToAppend[check].childNodes[1].disabled = true;
                            Array.prototype.forEach.call(itemsToAppend[check].childNodes[1].options, o => o.remove());
                            check++;
                        }
                    });
                }
            }
        } else {
            createSelect(inputField, formGroup, label);
        }
    } else {
        const input = document.createElement('input');

        if (inputField.isCommentsList === true) {
            input.setAttribute('is-comment-input', 'true');
        }

        if (inputField.type === 'checkbox') {
            input.className = 'form-check';
            if (inputField.default !== null) {
                if (inputField.default === true) {
                    input.defaultChecked = true;
                }
            }
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
    select.length = 0;
    const values = getValuesForSelect(list, selected_value);
    values.forEach(value => {
        const option = document.createElement('option');
        option.value = value;
        option.textContent = value;
        select.append(option);
    });
}

function getValuesForSelect(list, selected_value) {
    let values = [];
    for (const [key, value] of Object.entries(list.values)) {
        if (value[value.length - 2].value === selected_value) {
            values.push(value[value.length - 1].value)
        }
    }
    return values;
}

function setJson() {
    localStorage.setItem("edit", JSON.stringify(0));
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
        let highestPos = 0;
        inspections.forEach(inspection => {
            const matches = inspection[1].value.match(/(\d+)/);

            if (matches) {
                const pos = parseInt(matches[0])
                if (pos > highestPos) {
                    highestPos = pos
                }
            }
        });
        document.getElementById("1").value = highestPos + 1;
        let table = document.getElementById("inspections");

        table.innerHTML = "";

        if (!(inspections instanceof Array))
            inspections = [inspections];


        inspections.forEach((element, element_key) => {
            console.log(element)

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

            const td1 = document.createElement("td");

            let edit_button = document.createElement("button");
            edit_button.className = "btn btn-outline-info";
            edit_button.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                      <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                    </svg>`;

            edit_button.addEventListener("click", () => {
                editObject(element_key)
            })

            td1.append(edit_button);

            const td2 = document.createElement("td");

            let delete_button = document.createElement("button");
            delete_button.className = "btn btn-outline-danger";
            delete_button.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                      <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>`;

            delete_button.addEventListener("click", () => {
                deleteObject(element_key)
            })

            td2.append(delete_button);

            tr.append(td1);
            tr.append(td2);

            table.appendChild(tr);
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
    }

    saveNewObject(object);
});

function saveNewObject(object) {
    let storage = JSON.parse(localStorage.getItem("inspections"));

    if (!(storage instanceof Array))
        storage = [storage];
    storage.push(object);

    sortAndStore(storage);
}

function deleteObject(id) {
    let storage = JSON.parse(localStorage.getItem("inspections"));

    if (!(storage instanceof Array))
        storage = [storage];

    storage.splice(id, 1);

    sortAndStore(storage);
}

function editObject(element_key) {
    window.scrollTo(0, 0);

    localStorage.setItem("edit", JSON.stringify(element_key));

    let storage = JSON.parse(localStorage.getItem("inspections"));

    if (!(storage instanceof Array))
        storage = [storage];

    for (const [id, value] of Object.entries(storage[element_key])) {
        if (value.type === "checkbox") {
            document.getElementById(id).checked = value.value;
        } else {
            if (value.type === "select") {
                let event = new Event('click', {
                    'bubbles': true,
                    'cancelable': false
                });
                document.getElementById(id).disabled = false;
                document.getElementById(id).value = value.value;
                document.getElementById(id).dispatchEvent(event);
            } else {
                document.getElementById(id).value = value.value;
            }
        }
    }
}

function sortAndStore(storage) {
    storage.sort(alphaNumericSort);

    localStorage.setItem("inspections", JSON.stringify(storage));

    if (navigator.onLine) {
        syncData();
    }

    renderData();
}

function alphaNumericSort(as, bs) {
    as = as[1].value;
    bs = bs[1].value;
    let a, b, a1, b1, i = 0, n, L,
        rx = /(\.\d+)|(\d+(\.\d+)?)|([^\d.]+)|(\.\D+)|(\.$)/g;
    if (as === bs) return 0;
    a = as.toLowerCase().match(rx);
    b = bs.toLowerCase().match(rx);
    L = a.length;
    while (i < L) {
        if (!b[i]) return 1;
        a1 = a[i],
            b1 = b[i++];
        if (a1 !== b1) {
            n = a1 - b1;
            if (!isNaN(n)) return n;
            return a1 > b1 ? 1 : -1;
        }
    }
    return b[i] ? -1 : 0;
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
