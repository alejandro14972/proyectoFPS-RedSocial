<?php
$datosInsertar = "INSERT INTO  noticias(
                titulo, 
                bloque,
                fecha
        ) 
        VALUES 
        (
                'titulo bloque 1', 
		        'descripcion 1',
                        '".date(" Y-m-d")."'
        ),

        (
                'titulo bloque 2', 
		        'descripcion 2',
                        '".date(" Y-m-d")."'
        ),

        (
                'titulo bloque 3', 
		        'descripcion 3',
                        '".date(" Y-m-d")."'
        ),
        (
                'titulo bloque 4', 
		        'descripcion 4',
                        '".date(" Y-m-d")."'
        )
        ";