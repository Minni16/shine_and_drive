-- Migration script to add role-based access control
-- Run this SQL script in phpMyAdmin or MySQL command line

-- Add role column to admin table
ALTER TABLE `admin` ADD COLUMN `role` ENUM('admin', 'user') DEFAULT 'user' AFTER `Password`;

-- Update existing admin user to have admin role
UPDATE `admin` SET `role` = 'admin' WHERE `UserName` = 'admin' OR `id` = 1;

-- Set all other existing users to 'user' role (if any)
UPDATE `admin` SET `role` = 'user' WHERE `role` IS NULL OR (`UserName` != 'admin' AND `id` != 1);

