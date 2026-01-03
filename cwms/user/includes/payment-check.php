<?php
// Payment check - redirects to index if user hasn't completed payment
// This should be included after auth-check.php in pages that require payment

$username = $_SESSION['alogin'];

// Check if user has completed payment
$checkPaymentSql = "SELECT payment_completed FROM admin WHERE UserName = :username";
$checkPaymentQuery = $dbh->prepare($checkPaymentSql);
$checkPaymentQuery->bindParam(':username', $username, PDO::PARAM_STR);
$checkPaymentQuery->execute();
$paymentResult = $checkPaymentQuery->fetch(PDO::FETCH_OBJ);

// Also check if there's a completed payment in the payments table
$checkPaymentTableSql = "SELECT id FROM tbluserpayments WHERE username = :username AND paymentStatus = 'completed' LIMIT 1";
$checkPaymentTableQuery = $dbh->prepare($checkPaymentTableSql);
$checkPaymentTableQuery->bindParam(':username', $username, PDO::PARAM_STR);
$checkPaymentTableQuery->execute();

$hasPayment = false;
if ($paymentResult && $paymentResult->payment_completed == 1) {
    $hasPayment = true;
} elseif ($checkPaymentTableQuery->rowCount() > 0) {
    $hasPayment = true;
    // Update admin table if payment exists in payments table but not marked in admin table
    $updateSql = "UPDATE admin SET payment_completed = 1 WHERE UserName = :username";
    $updateQuery = $dbh->prepare($updateSql);
    $updateQuery->bindParam(':username', $username, PDO::PARAM_STR);
    $updateQuery->execute();
}

// If no payment completed, redirect to index page with message
if (!$hasPayment) {
    echo "<script>alert('Please complete a package payment to access this page.'); 
          window.location.href = '../index.php';</script>";
    exit;
}
?>

