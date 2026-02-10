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
    "pueblos" => [
        "texto" => "Pueblos",
        "enlace" => ["pueblos", "puebloInicial"],
        "hijos" => [
            "pueblos" => [
                "texto" => "Inicio",
                "enlace" => ["pueblos", "puebloInicial"]
            ],
            "conectar" => [
                "texto" => "Inicio",
                "enlace" => ["pueblos", "puebloInicial"]
            ],
            "desconectar" => [
                "texto" => "Inicio",
                "enlace" => ["pueblos", "puebloInicial"]
            ],

        ]
    ]
];
