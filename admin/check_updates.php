<?php
include "db.php";
header('Content-Type: application/json');
echo json_encode(['last_update' => get_last_update()]);

