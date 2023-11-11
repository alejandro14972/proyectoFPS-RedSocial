<?php
$datosInsertar = "INSERT INTO  usuarios(
                nombre, 
                nombrecompleto,
                clave, 
                descripcion, 
                correo,
                telefono,
                rol, 
                sexo,
                activo,
		centro
        ) 
        VALUES 
        (
                'Admin',
                'Admin',
                '1112', 
		'ADMINISTRADOR PAGINA WEB',
                'admin@gmail.com', 
                '695561981',
                'admin',
                'Hombre',
                1,
		'Centro de docencia online'
        );";
