let json = []

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

    json.push({label:'type'})

    inputs.appendChild(newDiv)
    newDiv.appendChild(newLabel)
    newDiv.appendChild(newInput)

    hiddenInputs.appendChild(typeInput)
}
