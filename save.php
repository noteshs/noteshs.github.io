<?php
header("Access-Control-Allow-Origin: *");

$content = $_POST['content'];

$filename = 'content.txt';

if (file_put_contents($filename, $content)) {
    $response = array('success' => true);
} else {
    $response = array('success' => false);
}

echo json_encode($response);
?>
