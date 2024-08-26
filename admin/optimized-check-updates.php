<?php
require_once "db.php";

header('Content-Type: application/json');

if (!isset($_GET['casino_id'])) {
    die(json_encode(['error' => 'Casino ID is required']));
}

$casino_id = intval($_GET['casino_id']);

function get_media_for_casino($casino_id) {
    $images = get_imgs_back();
    $videos = get_vids_back();
    
    $media = array_merge(
        array_filter($images, function($img) use ($casino_id) {
            return $img->casino_id == $casino_id;
        }),
        array_filter($videos, function($vid) use ($casino_id) {
            return $vid->casino_id == $casino_id;
        })
    );
    
    $media_data = array_map(function($item) {
        return [
            'type' => property_exists($item, 'src') && strpos($item->src, '.mp4') !== false ? 'video' : 'image',
            'src' => '../admin/' . $item->folder . $item->src
        ];
    }, $media);
    
    return [
        'count' => count($media),
        'data' => $media_data
    ];
}

$media_info = get_media_for_casino($casino_id);

echo json_encode([
    'media_count' => $media_info['count'],
    'media' => $media_info['data']
]);