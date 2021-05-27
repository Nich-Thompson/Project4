let dynamicLists = window.myArray;

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
    list.addEventListener('click', addList)
    let comments = document.getElementById('addComments')
    comments.addEventListener('click', addComments)
}

function addTextInput() {
    createInput('text')
}

function addNumberInput() {
    createInput('number')
}

function addDateTimeInput() {
    createInput('datetime-local')
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

    inputs.appendChild(newDiv)
    newDiv.appendChild(newLabel)
    newDiv.appendChild(newInput)

    hiddenInputs.appendChild(typeInput)
}

function addList(){
    let inputs = document.getElementById('inputs')
    let hiddenInputs = document.getElementById('hiddenInputs')

    let newDiv = document.createElement('div')
    newDiv.className = 'form-group col-md-4'

    const label = document.createElement('label');
    label.textContent = 'Kies een dynamische lijst'

    let select = document.createElement('select');
    select.className = 'form-select';
    select.name = 'selects[]';
    dynamicLists.forEach(dynamicList => {
        const option = document.createElement('option');
        option.value = dynamicList.id;
        option.textContent = dynamicList.is_main_list ? dynamicList.name + ' (Hoodflijst)' : dynamicList.name;
        select.append(option);
    });
    newDiv.append(label, select);
    inputs.append(newDiv);
}

function addComments(){
    const commentsList = document.getElementsByName('commentsList')
    if(commentsList.length === 0){
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
            if(!dynamicList.is_main_list){
                const option = document.createElement('option');
                option.value = dynamicList.id;
                option.textContent = dynamicList.name;
                select.append(option);
            }
        });
        newDiv.append(label, select);
        inputs.append(newDiv);
    }
}
