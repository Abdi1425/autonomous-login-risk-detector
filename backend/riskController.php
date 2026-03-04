<?php
// ✅ Enable all errors for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once './RiskEngine.php';

// Read JSON input safely
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Handle invalid JSON
if (!$data) {
    echo json_encode([
        "decision" => "ERROR",
        "score" => 0,
        "message" => "Invalid input: " . $input
    ]);
    exit;
}

// Initialize Risk Engine
$engine = new RiskEngine();
$result = $engine->evaluate($data);

// Optionally log result
$logEntry = date('Y-m-d H:i:s') . " | " . json_encode($data) . " | Decision: " . $result['decision'] . "\n";
file_put_contents('../logs/login_log.txt', $logEntry, FILE_APPEND);

// Return JSON response
header('Content-Type: application/json');
echo json_encode($result);
?>