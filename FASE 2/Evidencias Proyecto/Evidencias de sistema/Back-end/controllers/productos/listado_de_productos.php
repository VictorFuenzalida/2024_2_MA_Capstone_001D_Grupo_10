<?php


$sql_productos = "SELECT *, ca.categoria as categoria, us.email as email
                 FROM producto as pr INNER JOIN categoria as ca ON pr.id_categoria = ca.id_categoria 
                 INNER JOIN usuario as us ON us.id_usuario = pr.id_usuario";
$query_productos = $pdo->prepare($sql_productos);
$query_productos->execute();
$productos_datos = $query_productos->fetchAll(PDO::FETCH_ASSOC);
