<?php

include 'config.php';

setcookie("user_id", "", time() - 3600);
setcookie("priv_id", "", time() - 3600);
setcookie("user_nombre", "", time() - 3600);

header("Location: " . SITIO_WEB);
