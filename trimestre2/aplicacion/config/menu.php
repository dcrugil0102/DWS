<?php
return [
    "inicial" => [
        "texto" => "Inicio",
        "enlace" => ["inicial", "index"],
        "hijos" => [
            "inicial" => [
                "texto" => "Inicio",
                "enlace" => ["inicial", "index"]
            ]
        ]
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
            "error" => [
                "texto" => "Error",
                "enlace" => ["practicas2", "error"]
            ],
            "descarga1" => [
                "texto" => "Descarga 1",
                "enlace" => ["practicas2", "descarga1"]
            ],
            "descarga2" => [
                "texto" => "Descarga 2",
                "enlace" => ["practicas2", "descarga2"]
            ],
            "pedirDatos" => [
                "texto" => "Pedir datos",
                "enlace" => ["practicas2", "pedirDatos"]
            ],
            "peticionAjax" => [
                "texto" => "Peticion Ajax",
                "enlace" => ["practicas2", "peticionAjax"]
            ],
        ]
    ],

    "productos" => [
        "texto" => "Productos",
        "enlace" => ["productos", "index"],
        "hijos" => [
            "productos" => [
                "texto" => "Inicio",
                "enlace" => ["productos", "index"]
            ]
        ]
    ]
];
