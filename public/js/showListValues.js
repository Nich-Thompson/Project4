let valuesBox = null;
let input = null;
const sublistvalues = JSON.parse(window.count);

window.addEventListener('load', (e) => {
    valuesBox = document.getElementById('values-box');
    input = document.getElementById('sublist_value');
    if(input){
        input.addEventListener('change', (e) => {
            this.showValues();
        });
        this.showValues();
    }
});

function showValues(){
    valuesBox.innerHTML = '';
    const id = parseInt(input.value);
    let value_id = null;
    sublistvalues[1][0].forEach(value => {
        if(value.id === id){
            value_id = value.list_value_id;
        }
    });
    for(let index = 1; index < sublistvalues[1].length; index++){
        showValue = null;
        sublistvalues[1][index].forEach(value => {
            if(value.id === value_id){
                showValue = value;
            }
        });
        if(showValue){
            const formgroup = document.createElement('div');
            formgroup.className = 'form-group';
            const label = document.createElement('label');
            label.textContent = sublistvalues[0][index].name;
            const value = document.createElement('input');
            value.className = 'form-control';
            value.id = 'notEnabled';
            value.disabled = true;
            value.type = 'text';
            value.value = showValue.name
            formgroup.append(label, value);
            valuesBox.appendChild(formgroup);
            if(sublistvalues[1].length >= index+2){
                sublistvalues[1][index].forEach(value => {
                    if(value.id === value_id){
                        value_id = value.list_value_id;
                    }
                });
            }
        }
    }
}
