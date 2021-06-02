let dynamicLists = window.myArray[0];
let oldTemplate = window.myArray[1];

window.onload = function () {
    let text = document.getElementById('addText')
    text.addEventListener('click', addTextInput)
    let number = document.getElementById('addNumber')
    number.addEventListener('click', addNumberInput)
    let dateTime = document.getElementById('addDateTime')
    dateTime.addEventListener('click', addDateTimeInput)
    let checkbox = document.getElementById('addCheckbox')
    checkbox.addEventListener('click', addCheckbox)
    let list = document.getElementById('addList')
    list.addEventListener('click', () => addList(null, false))
    let comments = document.getElementById('addComments')
    comments.addEventListener('click', () => addList(null, true))
    if (oldTemplate) {
        loadOldInputs()
    }
}

function addTextInput(name = null) {
    createInput('text', name)
}

function addNumberInput(name = null) {
    createInput('number', name)
}

function addDateTimeInput(name = null) {
    createInput('datetime-local', name)
}

function addCheckbox(name = null) {
    createInput('checkbox', name)
}

function createInput(type, name = null) {
    let inputs = document.getElementById('inputs')
    let hiddenInputs = document.getElementById('hiddenInputs')

    let newDiv = document.createElement('div')
    newDiv.className = 'form-group col-md-4'

    let typeInput = document.createElement('input')
    typeInput.name = 'types[]'
    typeInput.hidden = true
    let newLabel = document.createElement('label')
    newLabel.className = 'ml-1'
    switch (type) {
        case 'text':
            newLabel.textContent = 'Label text input'
            typeInput.value = 'text'
            break;
        case 'number':
            newLabel.textContent = 'Label getal input'
            typeInput.value = 'number'
            break;
        case 'datetime-local':
            newLabel.textContent = 'Label datum input'
            typeInput.value = 'datetime-local'
            break;
        case 'checkbox':
            newLabel.textContent = 'Label checkbox'
            typeInput.value = 'checkbox'
    }

    let newInput = document.createElement('input')
    newInput.type = 'text'
    newInput.name = 'labels[]'
    newInput.className = 'form-control'
    newInput.placeholder = 'Labelnaam'
    // Need to do this check otherwise because method receives mouseEvents as name on new inputs
    if (typeof name === "string") {
        newInput.value = name
    }

    let deleteButton = document.createElement('button')
    deleteButton.className = 'float-right btn btn-danger'
    deleteButton.textContent = 'X'
    deleteButton.addEventListener('click', function () {
        newDiv.parentNode.removeChild(newDiv)
    })

    inputs.appendChild(newDiv)
    newDiv.appendChild(newLabel)
    newDiv.appendChild(deleteButton)
    newDiv.appendChild(newInput)

    hiddenInputs.appendChild(typeInput)
}

function addList(listId = null, is_comments_list) {
    const commentsList = document.getElementsByName('comments_list_id')
    if (!is_comments_list || commentsList.length === 0) {
        let inputs = document.getElementById('inputs')

        let newDiv = document.createElement('div')
        newDiv.className = 'form-group col-md-4'

        const label = document.createElement('label');
        if (is_comments_list) {
            label.textContent = 'Kies een opmerking lijst'
        }
        else {
            label.textContent = 'Kies een dynamische lijst'
        }

        let select = document.createElement('select');
        select.className = 'form-select';

        if (is_comments_list === true) {
            select.name = 'comments_list_id';
        } else {
            select.name = 'selects[]';
        }

        dynamicLists.forEach(dynamicList => {
            if (!is_comments_list || dynamicList.is_main_list) {
                const option = document.createElement('option');
                option.value = dynamicList.id;
                option.textContent = dynamicList.is_main_list ? dynamicList.name + ' (Hoofdlijst)' : dynamicList.name;
                select.append(option);
            }
        })
        // Need to do this check otherwise because method receives mouseEvents as listId on new inputs
        if (typeof listId === "string") {
            select.value = listId
        }

        let deleteButton = document.createElement('button')
        deleteButton.className = 'float-right btn btn-danger'
        deleteButton.textContent = 'X'
        deleteButton.addEventListener('click', function () {
            newDiv.parentNode.removeChild(newDiv)
        })
        newDiv.append(label, deleteButton, select);
        inputs.append(newDiv);
    }
}

function loadOldInputs() {
    oldTemplate.forEach(field => {
        switch (field.type) {
            case 'text':
                addTextInput(field.label)
                break;
            case 'number':
                addNumberInput(field.label)
                break;
            case 'datetime-local':
                addDateTimeInput(field.label)
                break;
            case 'checkbox':
                addCheckbox(field.label)
                break;
            case 'select':
                if (!field.isCommentsList) {
                    addList(field.list_id, false)
                }
                else {
                    addList(field.list_id, true)
                }
                break;
        }
    })
}

function addComments(listId = null) {
    const commentsList = document.getElementsByName('comments_list_id')
    if (commentsList.length === 0) {
        let inputs = document.getElementById('inputs')
        let hiddenInputs = document.getElementById('hiddenInputs')

        let newDiv = document.createElement('div')
        newDiv.className = 'form-group col-md-4'

        const label = document.createElement('label');
        label.textContent = 'Kies een opmerking lijst'

        let select = document.createElement('select');
        select.className = 'form-select';
        select.name = 'comments_list_id';
        dynamicLists.forEach(dynamicList => {
            if (dynamicList.is_main_list) {
                const option = document.createElement('option');
                option.value = dynamicList.id;
                option.textContent = dynamicList.name;
                select.append(option);
            }
        });
        // Need to do this check otherwise because method receives mouseEvents as listId on new inputs
        if (typeof listId === "string") {
            select.value = listId
        }

        let deleteButton = document.createElement('button')
        deleteButton.className = 'float-right btn btn-danger'
        deleteButton.textContent = 'X'
        deleteButton.addEventListener('click', function () {
            newDiv.parentNode.removeChild(newDiv)
        })
        newDiv.append(label, deleteButton, select);
        inputs.append(newDiv);
    }
}
