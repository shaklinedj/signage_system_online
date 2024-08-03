<?php

require 'admin\db.php'; // Archivo con las funciones que compartiste

header("Content-Type: application/json");

$requestMethod = $_SERVER["REQUEST_METHOD"];
$pathInfo = isset($_SERVER['PATH_INFO']) ? explode('/', trim($_SERVER['PATH_INFO'], '/')) : [];

switch ($pathInfo[0]) {
    case 'images':
        handleImages($requestMethod, $pathInfo);
        break;
    case 'videos':
        handleVideos($requestMethod, $pathInfo);
        break;
    case 'users':
        handleUsers($requestMethod, $pathInfo);
        break;
    default:
        http_response_code(404);
        echo json_encode(["error" => "Resource not found"]);
}

function handleImages($method, $path) {
    switch ($method) {
        case 'GET':
            if (isset($path[1])) {
                // Obtener imagen por ID
                $image = get_img($path[1]);
                echo json_encode($image);
            } else {
                // Obtener todas las imágenes
                $images = get_imgs_back();
                echo json_encode($images);
            }
            break;
        case 'POST':
            // Insertar nueva imagen
            $input = json_decode(file_get_contents('php://input'), true);
            $casino_id = $input['casino_id'];
            $folder = $input['folder'];
            $src = $input['src'];
            $fecha = $input['fecha'];
            insert_img($casino_id, $folder, $src, $fecha);
            echo json_encode(["message" => "Image created successfully"]);
            break;
        case 'DELETE':
            // Eliminar imagen por ID
            $id = $path[1];
            del($id);
            echo json_encode(["message" => "Image deleted successfully"]);
            break;
        default:
            http_response_code(405);
            echo json_encode(["error" => "Method not allowed"]);
            break;
    }
}

function handleVideos($method, $path) {
    switch ($method) {
        case 'GET':
            if (isset($path[1])) {
                // Obtener video por ID
                $video = get_vid($path[1]);
                echo json_encode($video);
            } else {
                // Obtener todos los videos
                $videos = get_vids_back();
                echo json_encode($videos);
            }
            break;
        case 'POST':
            // Insertar nuevo video
            $input = json_decode(file_get_contents('php://input'), true);
            $casino_id = $input['casino_id'];
            $folder = $input['folder'];
            $src = $input['src'];
            $fecha = $input['fecha'];
            insert_vid($casino_id, $folder, $src, $fecha);
            echo json_encode(["message" => "Video created successfully"]);
            break;
        case 'DELETE':
            // Eliminar video por ID
            $id = $path[1];
            delvid($id);
            echo json_encode(["message" => "Video deleted successfully"]);
            break;
        default:
            http_response_code(405);
            echo json_encode(["error" => "Method not allowed"]);
            break;
    }
}

function handleUsers($method, $path) {
    switch ($method) {
        case 'GET':
            // Obtener usuario por ID
            if (isset($path[1])) {
                $user = get_user($path[1]);
                echo json_encode($user);
            } else {
                http_response_code(400);
                echo json_encode(["error" => "User ID required"]);
            }
            break;
        case 'DELETE':
            // Eliminar usuario por ID
            if (isset($path[1])) {
                deluser($path[1]);
                echo json_encode(["message" => "User deleted successfully"]);
            } else {
                http_response_code(400);
                echo json_encode(["error" => "User ID required"]);
            }
            break;
        default:
            http_response_code(405);
            echo json_encode(["error" => "Method not allowed"]);
            break;
    }
}

