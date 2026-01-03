-- Migration script to add user information columns to admin table
-- Run this SQL script in phpMyAdmin or MySQL command line
-- This adds fullName, email, and phoneNumber columns to store user registration details

-- Add fullName column to admin table
ALTER TABLE `admin` ADD COLUMN `fullName` varchar(150) DEFAULT NULL AFTER `Password`;

-- Add email column to admin table
ALTER TABLE `admin` ADD COLUMN `email` varchar(150) DEFAULT NULL AFTER `fullName`;

-- Add phoneNumber column to admin table
ALTER TABLE `admin` ADD COLUMN `phoneNumber` varchar(20) DEFAULT NULL AFTER `email`;

-- Optional: Add unique constraint on email to prevent duplicate registrations
-- ALTER TABLE `admin` ADD UNIQUE KEY `unique_email` (`email`);

