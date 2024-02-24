<?php
header('Content-Type: application/json');
$request_uri = $_SERVER['REQUEST_URI'];
$uri_parts = explode('/', $request_uri);
$endpoint = implode('/', array_slice($uri_parts, 2));

include 'api.php';

// GET 
if (strpos($endpoint, 'api/nearest_hospitals') !== false) {
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      $parts = explode('/', $endpoint);
      if (count($parts) == 5) {
        $latitude = $parts[3];
        $longitude = $parts[4];
        nearest_hospitals($latitude, $longitude); 
      } else {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid endpoint format']);
      }
  } else {
      http_response_code(405);
      echo json_encode(['error' => 'Invalid request method for this endpoint']);
  }
}

?>
