# HalvingDates
Website to track cryptocurrency halving dates

https://halvingdates.com



## Setup cron job:

0 2 * * * cd /var/www/halvingdates.com && /usr/bin/node halving.js >> /var/www/halvingdates.com/halving-cron.log 2>&1
