
window.onload = function () {
    let text = document.getElementById('addText')
    text.addEventListener('click', addTextInput)
    let number = document.getElementById('addNumber')
    number.addEventListener('click', addNumberInput)
    let dateTime = document.getElementById('addDateTime')
    dateTime.addEventListener('click', addDateTimeInput)
    let checkbox = document.getElementById('addCheckbox')
    checkbox.addEventListener('click', addCheckbox)
}

function addTextInput() {
    createInput('text')
}

function addNumberInput() {
    createInput('number')
}

function addDateTimeInput() {
    createInput('dateTime')
}

function addCheckbox() {
    createInput('checkbox')
}

function createInput(type) {
    let inputs = document.getElementById('inputs')
    let newDiv = document.createElement('div')
    newDiv.className = 'form-group col-md-4'
    let newLabel = document.createElement('label')
    newLabel.className = 'ml-1'
    switch (type) {
        case 'text':
            newLabel.textContent = 'Label text input'
            break;
        case 'number':
            newLabel.textContent = 'Label getal input'
            break;
        case 'dateTime':
            newLabel.textContent = 'Label datum input'
            break;
        case 'checkbox':
            newLabel.textContent = 'Label checkbox'
    }

    let newInput = document.createElement('input')
    newInput.type = 'text'
    newInput.name = 'labels[]'
    newInput.className = 'form-control'
    newInput.placeholder = 'Labelnaam'

    inputs.appendChild(newDiv)
    newDiv.appendChild(newLabel)
    newDiv.appendChild(newInput)
}
