<?php
session_start();
include('includes/config.php');
include('includes/auth-check.php');
include('includes/khalti-config.php');

// Initialize Khalti Payment
if (isset($_POST['initiate_khalti'])) {
    $username = $_SESSION['alogin'];
    $packageType = intval($_POST['package_type']);
    $amount = floatval($_POST['amount']);
    
    // Package details
    $packageDetails = [
        1 => ['name' => 'Basic Wash', 'amount' => 2000],
        2 => ['name' => 'Standard Care', 'amount' => 3000],
        3 => ['name' => 'Premium Treatment', 'amount' => 4500]
    ];
    
    if (!isset($packageDetails[$packageType])) {
        echo json_encode(['success' => false, 'message' => 'Invalid package']);
        exit;
    }
    
    // Verify amount
    if ($amount != $packageDetails[$packageType]['amount']) {
        echo json_encode(['success' => false, 'message' => 'Amount mismatch']);
        exit;
    }
    
    // Generate unique purchase order ID
    $purchase_order_id = "PKG" . $packageType . "_" . time() . "_" . rand(1000, 9999);
    $purchase_order_name = $packageDetails[$packageType]['name'];
    
    // Prepare payment data for Khalti
    $payload = [
        'return_url' => KHALTI_RETURN_URL . '?package=' . $packageType,
        'website_url' => $protocol . "://" . $host . $basePath,
        'amount' => intval($amount * 100), // Khalti expects amount in paisa (multiply by 100)
        'purchase_order_id' => $purchase_order_id,
        'purchase_order_name' => $purchase_order_name,
        'customer_info' => [
            'name' => $username,
            'email' => $username . '@example.com', // You can get email from user profile
            'phone' => '9800000000' // You can get phone from user profile
        ]
    ];
    
    // Initialize payment with Khalti API
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, KHALTI_API_URL . '/epayment/initiate/');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Key ' . KHALTI_SECRET_KEY,
        'Content-Type: application/json',
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode == 200) {
        $result = json_decode($response, true);
        if (isset($result['payment_url'])) {
            // Store payment info in session for verification
            $_SESSION['khalti_payment'] = [
                'pidx' => $result['pidx'],
                'package_type' => $packageType,
                'amount' => $amount,
                'purchase_order_id' => $purchase_order_id
            ];
            
            echo json_encode([
                'success' => true,
                'payment_url' => $result['payment_url'],
                'pidx' => $result['pidx']
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to get payment URL']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Khalti API error: ' . $response]);
    }
    exit;
}

// If direct access, redirect
header('location: ../index.php');
exit;
?>

