let valuesBox = null;
let input = null;
const sublists = JSON.parse(window.count)[0]
const sublistvalues = JSON.parse(window.count)[1];

window.addEventListener('load', (e) => {
    valuesBox = document.getElementById('values-box');
    input = document.getElementById('sublist_value');
    if (input) {
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
    sublistvalues[0].forEach(value => {
        if(value.id === id){
            value_id = value.list_value_id;
        }
    });
    let $order = 10;
    for(let index = 1; index < sublistvalues.length; index++){
        showValue = null;
        sublistvalues[index].forEach(value => {
            if(value.id === value_id){
                showValue = value;
            }
        });
        if(showValue){
            const formgroup = document.createElement('div');
            formgroup.className = 'form-group order-' + $order;
            $order--;
            const label = document.createElement('label');
            label.textContent = getList(showValue.list_model_id).name;
            const value = document.createElement('input');
            value.className = 'form-control';
            value.id = 'notEnabled';
            value.disabled = true;
            value.type = 'text';
            value.value = showValue.name
            formgroup.append(label, value);
            valuesBox.appendChild(formgroup);
            if(sublistvalues.length >= index+2){
                sublistvalues[index].forEach(value => {
                    if(value.id === value_id){
                        value_id = value.list_value_id;
                    }
                });
            }
        }
    }

    function getList(id){
        let list = null;
        sublists.forEach(sublist=>{
            if(sublist.id === id){
                list = sublist;
            }
        });
        return list;
    }
}
