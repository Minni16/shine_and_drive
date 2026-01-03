<?php
// Khalti Payment Gateway Configuration
// Get your API keys from: https://khalti.com/merchant/

// Test Mode (for development)
define('KHALTI_TEST_SECRET_KEY', 'test_secret_key_xxxxxxxxxxxxxxxxxxxxx');
define('KHALTI_TEST_PUBLIC_KEY', 'test_public_key_xxxxxxxxxxxxxxxxxxxxx');

// Production Mode (uncomment and add your live keys when ready)
// define('KHALTI_LIVE_SECRET_KEY', 'live_secret_key_xxxxxxxxxxxxxxxxxxxxx');
// define('KHALTI_LIVE_PUBLIC_KEY', 'live_public_key_xxxxxxxxxxxxxxxxxxxxx');

// Environment: 'test' or 'live'
define('KHALTI_ENVIRONMENT', 'test');

// Get the appropriate keys based on environment
if (KHALTI_ENVIRONMENT === 'test') {
    define('KHALTI_SECRET_KEY', KHALTI_TEST_SECRET_KEY);
    define('KHALTI_PUBLIC_KEY', KHALTI_TEST_PUBLIC_KEY);
    define('KHALTI_API_URL', 'https://a.khalti.com/api/v2');
} else {
    define('KHALTI_SECRET_KEY', KHALTI_LIVE_SECRET_KEY);
    define('KHALTI_PUBLIC_KEY', KHALTI_LIVE_PUBLIC_KEY);
    define('KHALTI_API_URL', 'https://khalti.com/api/v2');
}

// Callback URLs
$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$basePath = str_replace('\\', '/', dirname(dirname(dirname($_SERVER['SCRIPT_NAME']))));
define('KHALTI_RETURN_URL', $protocol . "://" . $host . $basePath . "/user/process-payment.php");
define('KHALTI_CANCEL_URL', $protocol . "://" . $host . $basePath . "/user/");
?>

