let enabled = false;

window.onload = (event) => {
    let errors = document.getElementById('errors');
    if (errors != null) {
        enableInput();
    }
};

function enableInput()
{
    if(!enabled)
    {
        if(document.getElementById("archiveButton") !== null){
            document.getElementById("archiveButton").hidden = false;
        }
        document.getElementById("saveButton").hidden = false;
        document.getElementById("switchButton").textContent = "Bekijken";
        let elements = document.getElementsByTagName('input');
        for(let i = 0; i < elements.length; i++)
        {
            if( elements[i].id !== 'notEnabled') {
                elements[i].disabled = false;
            }
        }
        elements = document.getElementsByTagName('select');
        for(let i = 0; i < elements.length; i++)
        {
            if( elements[i].id !== 'notEnabled') {
                elements[i].disabled = false;
            }
        }
        enabled = !enabled;
    }
    else {
        if(document.getElementById("archiveButton") !== null) {
            document.getElementById("archiveButton").hidden = true;
        }
        document.getElementById("saveButton").hidden = true;
        document.getElementById("switchButton").textContent = "Bewerken";
        let elements = document.getElementsByTagName('input');
        for(let i = 0; i < elements.length; i++)
        {
            elements[i].disabled = true;
        }
        elements = document.getElementsByTagName('select');
        for(let i = 0; i < elements.length; i++)
        {
            elements[i].disabled = true;
        }
        enabled = !enabled;
    }
}
