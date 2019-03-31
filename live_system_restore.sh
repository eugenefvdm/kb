#!/usr/bin/env bash
mysqldump -hdev.vander.host -uvander -pn7q93B5DDWqWtYQ vander_wordpress > db.backup
mysql -uroot -ppassword wordpress_kb < db.backup
