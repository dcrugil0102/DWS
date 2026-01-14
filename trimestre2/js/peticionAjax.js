let min = document.getElementById("min");
let max = document.getElementById("max");
let patron = document.getElementById("patron");

function hacerPeticion() {
    console.log("hola mundo");

    fetch(`/peticionAjax?min=${min}&max=${max}&patron=${patron}`)
        .then((response) => response.text())
        .then((data) => {
            document.getElementById("resultado").innerHTML = data;
        });
}
