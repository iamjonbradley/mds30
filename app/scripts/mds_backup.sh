#!/bin/bash

####################################################################
#                       script variables                           #
####################################################################

# set paths
path=/data/backups
tmp=$path/tmp

# set date
date=$(date +%D)
day=$(date +%d).tar.gz

# set filenames
filename_database="$tmp/dump-$day"
filename_web_app="$tmp/site-$day"
filename_total="$path/$day"

# set email settings
subject="New Backup on MDS Production Server"
recipient="jonathan.b@adelpo.com"
message="/tmp/emailmessage.txt"

####################################################################
#                     backup mysql database                        #
####################################################################

# switch to tmp path
cd $tmp
# dump the database
mysqldump -u backup -pITMgt2009 mds_production > dump.sql
# zip the database
tar czvf $filename_database dump.sql
# remove the dump file
rm dump.sql

####################################################################
#                       backup the web app                         #
####################################################################

# switch to tmp path
cd $tmp
# backup the site
tar czvf $filename_web_app /data/apps/mds

####################################################################
#                        zip everything up                         #
####################################################################

# switch to base path
cd $path
# backup tmp dir
tar czvf $filename_total $tmp/*
# remove temp files
rm -rf $tmp/*

####################################################################
#              send the backup to the rsync server                 #
####################################################################

# switch to base path
cd $path
# rsync the file
rsync -azv --bwlimit=128 $filename_total 10.160.0.50::MDS3/MDS3/$day 

# exit
exit
