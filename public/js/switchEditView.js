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
        document.getElementById("archiveButton").hidden = false;
        document.getElementById("saveButton").hidden = false;
        document.getElementById("switchButton").textContent = "Bekijken";
        let elements = document.getElementsByClassName("form-control");
        for(let i = 0; i < elements.length; i++)
        {
            elements[i].disabled = false;
        }
        enabled = !enabled;
    }
    else {
        document.getElementById("archiveButton").hidden = true;
        document.getElementById("saveButton").hidden = true;
        document.getElementById("switchButton").textContent = "Bewerken";
        let elements = document.getElementsByClassName("form-control");
        for(let i = 0; i < elements.length; i++)
        {
            elements[i].disabled = true;
        }
        enabled = !enabled;
    }
}
