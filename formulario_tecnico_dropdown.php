<?php

$soporte = $_POST['ajax_tecnido_id'];

echo $soporte;

// // Dropdown tecnicos
// $tecnico = "SELECT 
//                 user_id, user_nombre
//             FROM 
//                 tickets.usuarios u
//                 inner join
//                 tickets.gruposoporte g
//                 on u.user_id = g.user_id
//             WHERE
//                 priv_id = 2
//             AND 
//                 gsoporte_id = '$soporte'
//             ;";

// $lista_tecnico = mysqli_query($link, $tecnico);

// ?>

// <option value="">Seleccionar un Tecnico</option>

// <?php

// while ($row_tecnico = mysqli_fetch_assoc($lista_tecnico)) {
//     if ($row[4] == $row_tecnico['user_id']) {
//         echo "<option value=" . $row_tecnico['user_id'] . " selected>" . $row_tecnico['user_nombre'] . "</option>";
//     } else {
//         echo "<option value=" . $row_tecnico['user_id'] . ">" . $row_tecnico['user_nombre'] . "</option>";
//     }
// }
