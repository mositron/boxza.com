#!/bin/bash
export LC_ALL=en_US.UTF-8
FILE="/var/www/boxza.com/backup/db/$(date +"%Y%m%d-%H")"
MONGO=" --username xxxxx --password xxxxx --db xxxxx --out $FILE"
mongodump --host 192.168.1.128 $MONGO/db1
mongodump --host 192.168.1.133 $MONGO/db2
mongodump --host 192.168.1.150 $MONGO/db3
mongodump --host 192.168.1.151 $MONGO/db4
mongodump --host 192.168.1.152 $MONGO/db5
mongodump --host 192.168.1.155 $MONGO/db6
tar zcfP  $FILE.tar.gz $FILE
rm -Rf $FILE
