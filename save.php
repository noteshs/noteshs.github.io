<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Origin: *'); // Allow cross-origin requests

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'];

    // Create a new Gist using GitHub API
    $data = [
        'description' => 'Website Content',
        'public' => true,
        'files' => [
            'content.txt' => [
                'content' => $content
            ]
        ]
    ];

    $options = [
        'http' => [
            'method' => 'POST',
            'header' => 'Content-Type: application/json',
            'content' => json_encode($data)
        ]
    ];

    $context = stream_context_create($options);
    $response = file_get_contents('https://api.github.com/gists', false, $context);

    if ($response) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo 'Invalid Request';
}
?>
