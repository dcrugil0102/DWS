<?php
return [
    "inicio" => [
        "texto" => "Inicio",
        "enlace" => ["inicial", "index"],
        "hijos" => []
    ],

    "practicas1" => [
        "texto" => "Prácticas 1",
        "enlace" => ["practicas1", "miindice"],
        "hijos" => [
            "ejercicio1" => [
                "texto" => "Ejercicio 1",
                "enlace" => ["practicas1", "ejercicio1"]
            ],
            "ejercicio2" => [
                "texto" => "Ejercicio 2",
                "enlace" => ["practicas1", "ejercicio2"]
            ],
            "ejercicio3" => [
                "texto" => "Ejercicio 3",
                "enlace" => ["practicas1", "ejercicio3"]
            ],
            "ejercicio7" => [
                "texto" => "Ejercicio 7",
                "enlace" => ["practicas1", "ejercicio7"]
            ],
            "ejer5" => [
                "texto" => "Ejercicio 5",
                "enlace" => ["practicas1", "ejer5"]
            ],
        ]
    ],

    "practicas2" => [
        "texto" => "Prácticas 2",
        "enlace" => ["practicas2", "index"],
        "hijos" => [
            "descarga1" => [
                "texto" => "Descarga 1",
                "enlace" => ["practicas2", "descarga1"]
            ],
            "peticionAjax" => [
                "texto" => "Peticion Ajax",
                "enlace" => ["practicas2", "peticionAjax"]
            ],
        ]
    ]
];
