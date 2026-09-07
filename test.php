<?php
// File location: public_html/dootor-enterprise.kisprojectslab.com/test.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h2>Laravel Diagnostic Boot Test</h2>";

// 1. Check Vendor Autoload
if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
    die("<b style='color:red;'>vendor/autoload.php not found in " . __DIR__ . "</b>");
}
require __DIR__ . '/vendor/autoload.php';
echo "✅ 1. Autoload loaded successfully.<br>";

// 2. Check .env file
if (!file_exists(__DIR__ . '/.env')) {
    die("<b style='color:red;'>.env file NOT found in " . __DIR__ . "</b>");
}
echo "✅ 2. .env file found.<br>";

// 3. Bootstrap Laravel App
try {
    $app = require_once __DIR__ . '/bootstrap/app.php';
    echo "✅ 3. Application bootstrapped successfully.<br>";

    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    
    // Attempt request handle
    $response = $kernel->handle(
        $request = Illuminate\Http\Request::capture()
    );

    echo "✅ 4. Request handled! Status Code: " . $response->getStatusCode() . "<br>";
    if ($response->getStatusCode() === 500) {
        echo "<b style='color:red;'>HTTP 500 status code was generated during request.</b><br>";
    }
} catch (\Throwable $e) {
    echo "<hr><h3 style='color:red;'>💥 CAUGHT FATAL EXCEPTION:</h3>";
    echo "<b>Error Message:</b> " . htmlspecialchars($e->getMessage()) . "<br>";
    echo "<b>File:</b> " . $e->getFile() . " (Line " . $e->getLine() . ")<br><br>";
    echo "<b>Stack Trace:</b><br><pre style='background:#f4f4f4; padding:10px; border:1px solid #ccc;'>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}
