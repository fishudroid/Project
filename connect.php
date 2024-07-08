<?php
// Database connection code (no output)
$conn = new mysqli('localhost', 'root', '', 'project');

if ($conn->connect_error) {
    // Instead of echoing, log the error or handle it silently
    error_log("Connection failed: " . $conn->connect_error);
}