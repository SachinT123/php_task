#!/bin/sh

echo "Enter password for MySQL root user : "
read pass

echo "Enter database name : "
read dbname

mysql -u root -p"$pass" "$dbname"<info.sql<<EOFMYSQL




