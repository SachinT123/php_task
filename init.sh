#!/bin/sh

echo "Enter password for MySQL root user : "
read pass

echo "Enter database name : "
read dbname

echo "\nIf the entered database exists, tables will be created in it, otherwise new database wil be created\n"

mysql -u root -p"$pass" -e "create database $dbname"

mysql -u root -p"$pass" "$dbname"<info.sql
sed -i "3i \   \ \$db_name = \"$dbname\";" ./dbConnect.php
sed -i "3i \   \ \$db_pass = \"$pass\";" ./dbConnect.php
