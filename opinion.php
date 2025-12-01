<?php
  $title = 'Bitcoin Halving Opinions';
  $description = 'Comments from crypto twitter about the effect of the halvening on Bitcoin and current market conditions';
?>
<!DOCTYPE html>
<html lang="en">
<?php include('components/head.php'); ?>
<body>
  <?php include('components/topbar.php'); ?>
  <div class="content">
    <div class="container">
      <h1>Opinions from Crypto Twitter</h1>
      <hr>
      <a href="https://twitter.com/100trillionUSD" target="_blank"><img src="img/twitter/t12.png" class="pull-left twitter-image" alt="crypto twitter halving" /></a>
      <a href="https://twitter.com/robustus" target="_blank"><img src="img/twitter/t9.png" class="pull-left twitter-image" alt="crypto twitter halving" /></a>
      <a href="https://twitter.com/sunnydecree" target="_blank"><img src="img/twitter/t10.png" class="pull-left twitter-image" alt="crypto twitter halving" /></a>
      <a href="https://twitter.com/vajolleratzii" target="_blank"><img src="img/twitter/t11.png" class="pull-left twitter-image" alt="crypto twitter halving" /></a>
      <a href="https://twitter.com/CoinPentium" target="_blank"><img src="img/twitter/t13.png" class="pull-left twitter-image" alt="crypto twitter halving" /></a>
      <a href="https://twitter.com/100trillionUSD" target="_blank"><img src="img/twitter/t1.png" class="pull-left twitter-image" alt="crypto twitter halving" /></a>
      <a href="https://twitter.com/TheStalwart" target="_blank"><img src="img/twitter/t2.png" class="pull-left twitter-image" alt="crypto twitter halving" /></a>
      <a href="https://twitter.com/oddgems" target="_blank"><img src="img/twitter/t3.png" class="pull-left twitter-image" alt="crypto twitter halving" /></a>
      <a href="https://twitter.com/SatoshiFlipper" target="_blank"><img src="img/twitter/t4.png" class="pull-left twitter-image" alt="crypto twitter halving" /></a>
      <a href="https://twitter.com/bloreka_labs" target="_blank"><img src="img/twitter/t5.png" class="pull-left twitter-image" alt="crypto twitter halving" /></a>
      <a href="https://twitter.com/oliverzok" target="_blank"><img src="img/twitter/t6.png" class="pull-left twitter-image" alt="crypto twitter halving" /></a>
      <a href="https://twitter.com/DesiCryptoHodlr" target="_blank"><img src="img/twitter/t7.png" class="pull-left twitter-image" alt="crypto twitter halving" /></a>
      <a href="https://twitter.com/scottmelker" target="_blank"><img src="img/twitter/t8.png" class="pull-left twitter-image" alt="crypto twitter halving" /></a>


      <div class="clear"></div>
      <a href="https://halvingdates.com" class="view-full-link">View full table</a>
      <div id="sub-halving-table"></div>

    </div>

  </div>
  <?php include('components/footer.php'); ?>
  <script>
    loadJSON((inf) => {
      const nowTS = new Date().getTime();
      const year = new Date().getFullYear();
      let table = `<table class="tbl tbl-halving-dates"><tr><th>Symbol</th><th>Cryptocurrency</th><th class="hide-mobile">Halving Date</th></tr>`;
      Object.keys(inf).forEach((sym) => {
        const halvingDate = new Date(nowTS + inf[sym].halvingTime).toUTCString().substr(0,22);
        table += `<tr onclick="window.location='crypto.php?sym=${sym}&name=${encodeURIComponent(inf[sym].name)}';"><td><div><img src="img/icons/${sym}.png" class="crypto-icon" /></div> ${sym.toUpperCase()}</td><td><a href="crypto.php?sym=${sym}&name=${encodeURIComponent(inf[sym].name)}">${inf[sym].name}</a></td><td>${halvingDate}</td></tr>`;
      });
      table += `</table>`;
      document.getElementById('sub-halving-table').innerHTML = table;
    });
  </script>
</body>
</html>