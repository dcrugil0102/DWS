function hacerPeticion() {
    let min = document.getElementById("min").value;
    let max = document.getElementById("max").value;
    let patron = document.getElementById("patron").value;

    fetch(`/peticionAjax?min=${min}&max=${max}&patron=${patron}`)
        .then((response) => response.text())
        .then((data) => {
            document.getElementById("resultado").innerHTML = data;
        })
        .catch((error) => console.error("Error:", error));
}
