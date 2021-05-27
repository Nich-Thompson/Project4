let data = window.myArray[0];

document.getElementById("offline").style.display = "none";

setJson();

function setJson() {
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
        let div = document.getElementById("inspections");

        div.innerHTML = "";

        if (!(inspections instanceof Array))
            inspections = [inspections];


        inspections.forEach(element => {
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
                    td.textContent = new Date(value.value).toLocaleString();
                } else {
                    td.textContent = value.value;
                }
                tr.append(td);
            }

            div.appendChild(tr);
        })
    }
}

window.addEventListener('online', () => {
    document.getElementById("offline").style.display = "none";
    syncData();
});
window.addEventListener('offline', () => {
    document.getElementById("offline").style.display = "block";
});
