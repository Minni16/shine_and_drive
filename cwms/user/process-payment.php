<?php
session_start();
include('includes/config.php');
include('includes/auth-check.php');

// Process eSewa payment callback
if (isset($_POST['esewa_submit'])) {
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
        echo "<script>alert('Invalid package selected'); window.history.back();</script>";
        exit;
    }
    
    // Verify amount matches package
    if ($amount != $packageDetails[$packageType]['amount']) {
        echo "<script>alert('Amount mismatch'); window.history.back();</script>";
        exit;
    }
    
    // Generate transaction ID
    $transactionId = 'TXN' . time() . rand(1000, 9999);
    
    // For now, we'll simulate payment success (in production, verify with eSewa API)
    // In production, you would verify the payment with eSewa's verification API
    
    // Insert payment record
    $sql = "INSERT INTO tbluserpayments (username, packageType, amount, paymentStatus, paymentMode, transactionId, paymentDate) 
            VALUES (:username, :packageType, :amount, 'completed', 'eSewa', :transactionId, NOW())";
    $query = $dbh->prepare($sql);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':packageType', $packageType, PDO::PARAM_INT);
    $query->bindParam(':amount', $amount, PDO::PARAM_STR);
    $query->bindParam(':transactionId', $transactionId, PDO::PARAM_STR);
    $query->execute();
    
    // Update admin table to mark payment as completed
    $updateSql = "UPDATE admin SET payment_completed = 1 WHERE UserName = :username";
    $updateQuery = $dbh->prepare($updateSql);
    $updateQuery->bindParam(':username', $username, PDO::PARAM_STR);
    $updateQuery->execute();
    
    // Redirect to dashboard
    echo "<script>alert('Payment successful! You now have access to the dashboard.'); 
          window.location.href = 'dashboard.php';</script>";
    exit;
}

// Handle eSewa callback (when eSewa redirects back)
if (isset($_GET['oid']) && isset($_GET['amt']) && isset($_GET['refId'])) {
    $username = $_SESSION['alogin'];
    $oid = $_GET['oid']; // Order ID
    $amt = $_GET['amt']; // Amount
    $refId = $_GET['refId']; // eSewa Reference ID
    
    // Verify payment with eSewa (in production, use eSewa's verification API)
    // For now, we'll mark as completed
    
    // Extract package type from order ID (format: PKG1_timestamp_random)
    $packageType = 1; // Default
    if (strpos($oid, 'PKG1') !== false) $packageType = 1;
    elseif (strpos($oid, 'PKG2') !== false) $packageType = 2;
    elseif (strpos($oid, 'PKG3') !== false) $packageType = 3;
    
    // Log the callback for debugging (remove in production)
    error_log("eSewa Callback - OID: $oid, Amount: $amt, RefId: $refId, User: $username");
    
    // Check if payment already processed
    $checkSql = "SELECT id FROM tbluserpayments WHERE transactionId = :oid AND paymentStatus = 'completed'";
    $checkQuery = $dbh->prepare($checkSql);
    $checkQuery->bindParam(':oid', $oid, PDO::PARAM_STR);
    $checkQuery->execute();
    
    if ($checkQuery->rowCount() == 0) {
        // Insert payment record
        $sql = "INSERT INTO tbluserpayments (username, packageType, amount, paymentStatus, paymentMode, transactionId, esewaRefId, paymentDate) 
                VALUES (:username, :packageType, :amount, 'completed', 'eSewa', :transactionId, :refId, NOW())";
        $query = $dbh->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':packageType', $packageType, PDO::PARAM_INT);
        $query->bindParam(':amount', $amt, PDO::PARAM_STR);
        $query->bindParam(':transactionId', $oid, PDO::PARAM_STR);
        $query->bindParam(':refId', $refId, PDO::PARAM_STR);
        $query->execute();
        
        // Update admin table
        $updateSql = "UPDATE admin SET payment_completed = 1 WHERE UserName = :username";
        $updateQuery = $dbh->prepare($updateSql);
        $updateQuery->bindParam(':username', $username, PDO::PARAM_STR);
        $updateQuery->execute();
    }
    
    // Redirect to dashboard
    echo "<script>alert('Payment successful! You now have access to the dashboard.'); 
          window.location.href = 'dashboard.php';</script>";
    exit;
}

// If no valid request, redirect to index
header('location: ../index.php');
exit;
?>

