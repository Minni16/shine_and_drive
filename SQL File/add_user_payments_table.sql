-- Add table to track user package payments
-- This table tracks which package a user has purchased and payment status

CREATE TABLE IF NOT EXISTS `tbluserpayments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `packageType` int(11) NOT NULL COMMENT '1=Basic, 2=Standard, 3=Premium',
  `amount` decimal(10,2) NOT NULL,
  `paymentStatus` enum('pending','completed','failed') DEFAULT 'pending',
  `paymentMode` varchar(50) DEFAULT NULL COMMENT 'eSewa, Card, etc',
  `transactionId` varchar(255) DEFAULT NULL,
  `esewaRefId` varchar(255) DEFAULT NULL,
  `paymentDate` timestamp NULL DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `lastUpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `packageType` (`packageType`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Add payment_completed column to admin table to track if user has completed any payment
-- Check if column exists before adding (MySQL doesn't support IF NOT EXISTS for ALTER TABLE)
SET @dbname = DATABASE();
SET @tablename = 'admin';
SET @columnname = 'payment_completed';
SET @preparedStatement = (SELECT IF(
  (
    SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
    WHERE
      (table_name = @tablename)
      AND (table_schema = @dbname)
      AND (column_name = @columnname)
  ) > 0,
  'SELECT 1',
  CONCAT('ALTER TABLE ', @tablename, ' ADD COLUMN ', @columnname, ' tinyint(1) DEFAULT 0 COMMENT ''1 if user has completed at least one package payment''')
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;

