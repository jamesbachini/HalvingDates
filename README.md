# HalvingDates
Website to track cryptocurrency halving dates

## Update halving data
- Install deps once: `npm ci` (uses `package-lock.json`/`package.json`).
- Manually refresh data files: `npm run update-halving` (runs `node halving.js` and writes `data/halving.json` plus a dated backup).

### Cron example (runs every 30 minutes)
Use `crontab -e` and add (adjust paths/node binary as needed):
```
*/30 * * * * cd /mnt/c/code/Halvingdates && /usr/bin/node halving.js >> /mnt/c/code/Halvingdates/halving-cron.log 2>&1
```
Ensure the working directory is correct so JSON outputs land in `data/`.

https://halvingdates.com
