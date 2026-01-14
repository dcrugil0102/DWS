let dominio = window.location.protocol + "//" + window.location.hostname;
let url = dominio + "/practicas2/pedirDatos";

document.getElementById("form").addEventListener("submit", (event) => {
    event.preventDefault();
});

document.getElementById("btn").addEventListener("click", () => {
    fetch(url, {
        method: "GET",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "",
    }).then((response) => {
        if (response.ok) {
            response.json().then((resp) => {
                resultado.innerhtml = resp["datos"];
            });
        }
    });
});
