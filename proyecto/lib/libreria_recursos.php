<?php
$datosInsertar = "INSERT INTO  recursos(
                nombreRecurso, 
                subido,
                descripcion,
                nombre,
                privacidad,
                fecha
        ) 
        VALUES 
        (
                'imagenprueba', 
		'borja@gmail.com',
                'recurso de prueba',
                'descarga.jpg',
                'privado',
                '".date(" Y-m-d")."'
        )
        ";