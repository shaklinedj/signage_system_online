

<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Connection: keep-alive');

include "../admin/db.php";
/*
function checkForUpdates() {
    // Obtén la última actualización de la base de datos
    $last_update = get_last_update(); // Esta función debe retornar la última fecha de actualización

    // Envía el evento SSE
    echo "event: update\n";
    echo "data: " . json_encode(['last_update' => $last_update]) . "\n\n";

    // Enviar un espacio en blanco para mantener la conexión activa
    echo ":\n\n";
    flush();
}

// Mantén la conexión abierta y verifica actualizaciones cada X segundos
while (true) {
    checkForUpdates();
    sleep(3); // Verifica actualizaciones cada 30 segundos
}

*/






function checkForUpdates() {
    // Obtén la última actualización de la base de datos
    $last_update = get_last_update(); // Esta función debe retornar la última fecha de actualización

    // Obtén las nuevas imágenes y videos
    $images = get_imgs_back();
    $videos = get_vids_back();

    // Construye los datos para enviar al cliente
    $data = [
        'last_update' => $last_update,
        'images' => $images,
        'videos' => $videos
    ];

    // Envía el evento SSE
    echo "event: update\n";
    echo "data: " . json_encode($data) . "\n\n";

    // Enviar un espacio en blanco para mantener la conexión activa
    echo ":\n\n";
    flush();
}

// Mantén la conexión abierta y verifica actualizaciones cada 30 segundos
while (true) {
    checkForUpdates();
    sleep(30); // Verifica actualizaciones cada 30 segundos
}
?>
