<?php
  if (isset($_GET['sym']) && isset($_GET['name'])) {
    $sym = preg_replace("/[^a-zA-Z0-9 ]/","",$_GET['sym']);
    $name = preg_replace("/[^a-zA-Z0-9 ]/","",$_GET['name']);
    $lower = strtolower($name);
    $coingecko = str_replace(" ","-",$lower);
    if ($coingecko === 'bitcoin-sv') {
      $coingecko = 'bitcoin-cash-sv';
    }
  } else {
    exit();
  }
?>
<!DOCTYPE html>
<html lang="en">
<?php include('components/head.php'); ?>
<body>
  <?php include('components/topbar.php'); ?>
  <div class="content">
    <div class="container">
      <h1>The <?php echo $name; ?> Halving (Halvening)</h1>
      <hr>
      <div class="pull-left side-icon"><img src="img/icons/<?php echo $sym; ?>.png" alt="<?php echo $name; ?> halving" /></div>
      <p>The next halvening for <?php echo $name.' ('.$sym.')'; ?> will take place on approximately <span class="halving-date"></span> at block number <span class="halving-block"></span>. The current block height is <span class="block-height"></span> and each block takes approximately <span class="block-time"></span> seconds to mine.</p>
      <h2>Countdown</h2>
      <div id="crypto-timer" class="timer">
        <ul>
          <li><span id="crypto-days">0</span>Days</li>
          <li><span id="crypto-hours">0</span>Hours</li>
          <li><span id="crypto-minutes">0</span>Mins</li>
          <li><span id="crypto-seconds">0</span>Secs</li>
        </ul>
      </div>
      <p id="additional-text"></p>
      <p>All dates are estimated using current and expected block completion times.</p>
      <div class="ibox-content">
        <script src="https://widgets.coingecko.com/coingecko-coin-price-chart-widget.js"></script>
        <coingecko-coin-price-chart-widget currency="usd" coin-id="<?php echo $coingecko; ?>" locale="en" height="300"></coingecko-coin-price-chart-widget>			
      </div>
      <div>
        <ins class="adsbygoogle"
          style="display:block"
          data-ad-client="ca-pub-7452885367396051"
          data-ad-slot="9412264744"
          data-ad-format="link" 
          data-full-width-responsive="true">
        </ins>
      </div>
      <img src="img/rocket.svg" class="rocket" alt="crypto halving" />
      <p>You can purchase Cryptocurrency from <a href="https://www.coinbase.com/join/bachin_sq" target="_blank" rel="nofollow">Coinbase</a></p>
      <br><br>
      <p><a href="https://halvingdates.com" class="view-full-link">View full table</a></p>
      <div id="sub-halving-table"><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></div>
      <div id="footer-ad">
        <!-- HalvingDates.com Horizontal -->
        <ins class="adsbygoogle"
            style="display:block"
            data-ad-client="ca-pub-7452885367396051"
            data-ad-slot="8234032568"
            data-ad-format="auto"
            data-full-width-responsive="true"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
      </div>
    </div>
  </div>
  <?php include('components/footer.php'); ?>
  <script>
    loadJSON((inf) => {
      const nowTS = new Date().getTime();
      const year = new Date().getFullYear();
      const sym = `<?php echo $sym; ?>`;
      const halvingDate = new Date(nowTS + inf[sym].halvingTime).toUTCString().substr(0,22);
      document.querySelectorAll('.halving-date').forEach((el) => el.innerHTML = halvingDate);
      document.querySelectorAll('.halving-block').forEach((el) => el.innerHTML = inf[sym].halvingBlock);
      document.querySelectorAll('.block-height').forEach((el) => el.innerHTML = inf[sym].blockHeight);
      document.querySelectorAll('.block-time').forEach((el) => el.innerHTML = inf[sym].blockTime / 1000);
      const cryptoTimer = setTimer('crypto',inf[sym].halvingTime);
      let additionalText;
      if (sym === 'btc') {
        additionalText = `<p>The 2028 Bitcoin halving event cuts the supply of newly minted Bitcoin distributed to miners from 6.25 to 3.125 BTC per block (every 10 minutes).</p><p>The 2020 Bitcoin halving event took place at 19:23 UTC on the 11th May 2020. Bitcoin at the halving was priced on exchange at $8683</p>
        <p>The Bitcoin network is powered by miners who are rewarded with Bitcoin which they then sell on exchange to pay for their costs. Bitcoin mining is a big business with $10 million USD worth of Bitcoin mined and distributed each day at the start of 2020.</p>
        <p>Bitcoin has a fixed supply with a total limit of 21,000,000 Bitcoins which can ever be created. To achieve this limit the mining rewards are reduced in half once every four years. This event is known as halving or halvening and is set to happen once every 210,000 blocks.</p>
        <p>Each block in the Bitcoin blockchain stores transactional data and takes around 10 minutes to mine. We can therefore predict the date for the Bitcoin halvening by looking at the current block height or block number and calculating how long the remaining blocks will take to mine.</p>
        <img src="img/bitcoin.png" class="responsive-image btc-big-logo" />
        <table class="tbl tbl-bitcoin">
          <tr><th>Event</th><th>Date</th><th>Block No.</th><th>Mining Reward</th></tr>
          <tr><td>Bitcoin Launch</td><td>3rd January 2009</td><td>0</td><td>50</td></tr>
          <tr><td>1st Halving</td><td>28th Nov 2012</td><td>210,000</td><td>25</td></tr>
          <tr><td>2nd Halving</td><td>9th July 2016</td><td>420,000</td><td>12.5</td></tr>
          <tr><td>3rd Halving</td><td>11th May 2020</td><td>630,000</td><td>6.25</td></tr>
          <tr><td>4th Halving</td><td>19th April 2024</td><td>840,000</td><td>3.125</td></tr>
          <tr><td>5th Halving</td><td>2028*</td><td>1,050,000</td><td>1.5625</td></tr>
          <tr><td>6th Halving</td><td>2032*</td><td>1,260,000</td><td>0.78125</td></tr>
        </table>
        <img src="img/bitcoin-halving.png" class="responsive-image" alt="bitcoin halving" />
        <p>Bitcoin, the flagship cryptocurrency, uses a process known as "halving" to reduce the supply of new coins entering circulation. This protocol directly influences several aspects of the digital currency, notably its inherent worth and incentives for mining. As a result of this unique feature of bitcoin and its finite supply, digital scarcity is inherently established.</p>
        <p>When a bitcoin transaction is made, it’s grouped with others into a "block" Miners then verify these transactions via solving complex mathematical problems. Once this block is validated, it's attached to a chain of preceding blocks, forming a "blockchain". The miners are rewarded with new bitcoins for their function, which introduces new coins into circulation.</p>
        <p>Bitcoin halving is a fundamental part of the Bitcoin protocol and takes place approximately every four years or after 210,000 blocks have been mined. Whenever a bitcoin halving occurs, the rewards that miners receive for validating transactions effectively halves. For instance, when Bitcoin was introduced in 2009, the block reward was 50 Bitcoin. After the first halving in 2012, it was 25, then 12.5 in 2016, 6.25 in May 2020 and 3.125 in Spring 2024 This process will continue until all 21 million bitcoins are in circulation, upon which mining will solely be incentivized through transaction fees.</p>
        <p>The direct impact of the halving is a cutdown in the rate at which new bitcoins are generated, thus reducing the available supply. This delay in supply growth induces digital scarcity, a feature that separates Bitcoin from traditional fiat currencies. Traditional currencies, regulated by central banks, can inflate their supply to control economic variables like inflation and unemployment. In contrast, Bitcoin maintains a cap on its quantity, injecting predictability and transparency into the cryptocurrency's economy.</p>
        <p>The appeal of digital scarcity stems from the principles of supply and demand. As the value of an asset is proportionate to its scarcity, if demand for a good remains constant but its availability decreases, the price should naturally increase. This principle is intrinsically applied to Bitcoin through halving events and finite supply. While demand factors for bitcoin are multifaceted, encompassing aspects like institutional adoption and regulatory occurrences, supply is entirely predictable and diminishing.</p>
        <p>Beyond pricing implications, halving events also affect the security of the Bitcoin network. As rewards decrease, smaller miners may find their operations no longer profitable, which could consolidate mining power into fewer hands, potentially making the network more susceptible to attacks. However, a counter-argument is that as prices rise due to scarcity, the profitability of mining should also increase, incentivizing miners to stay active.</p>
        <p>In the long-term reducing the mining distribution should have a strong effect on the value due to the supply and demand being positively affected.</p>
        
        <img src="img/bitcoin-halving-price.png" class="responsive-image" alt="bitcoin halving price" />
        <p>The price was $654 USD per Bitcoin before the halvening event in July 2016. By the 2020 halving it had reached $8683 having previously hit a high just over $20,000 in late 2017.</p>`;
        
      } else if (sym === 'mona') {
        additionalText = `Monacoin or MONA is the first cryptocurrency of Japan. It started back in 2014 and has 1.5 minute blocks. The total supply is just over 105 million coins. The Lyra2RE v2 algorithm claims ASIC resistance consensus  which means it can't be mined in large ASIC server farms like Bitcoin. The coin is used for tipping in the gaming and streaming sector. There are a number of ATM's in Japan where you can use MONA as a payment method. The halving events for Monacoin occur every 1051k blocks which is roughly 3 years. There was no premine meaning the developers did not allocate themselves tokens. More information is available via their website at <a href="https://monacoin.org" target="_blank">Monacoin.org</a>`;
      } else if (sym === 'zec') {
        additionalText = `
        Additional info provided by email (unverified):<br><br>
        ZCash has only had a single halving event, back on November 18, 2020 at 12:37 UTC, ZCash passed block height 1046400 to trigger the event that cuts miners' rewards from 6.25 ZEC to 3.125 ZEC per block mined.<br><br>
        ZCash's next halving will take place at ~November 15, 2024, on block height: 2726400<br><br>
        Third halving will happend sometime in 2028 on block height 4406400 and so on.<br><br>
        <hr>
        <br><br>
        Zcash is a privacy coin which means transactions on the blockchain are designed to protect the identity of the sending and receiving parties. The private shielding uses zero-knowledge proofs to allow verification of transactions without revealing details. Where as transactions on the Bitcoin network are completely transparent Zcash is designed to protect the identies of it's users. It was originally developed in 2016 and uses a proof of work algorithm. Currently each block includes a 12.5 ZEC reward of which the algorithm subtracts 20% to go to the founders, developers and early investors.<br><br>
        After the halving event in 2020 Zcash's reward will be reduced to 6.25 ZEC. This event will also signify the end of the founders reward which will expire at the same time.`;
      } else if (sym === 'btg') {
        additionalText = `The 2020 Bitcoin Gold Halving occured on Apr 18, 2020 1:44:22 PM.<br>Since the 2020 halving BTG mining reward is now 6.25 BTG per block. The next Bitcoin Gold Halving is estimated for 2024.<br><br>Bitcoin Gold forked from the main Bitcoin chain on October 24th 2017. The idea behind the fork was to do with discontent with the mining sector and ASIC devices leading to more centralisation. By using an algorithm which blocked ASIC devices they could open up mining to individuals using GPU devices.<br><br>Controversially the developers of Bitcoin Gold included 100,000 coins to be set aside as an endowment in a post-mine. This caused 8000 blocks to be mined in rapid succession and affected the halving dates going forwards.<br><br>The halving date for Bitcoin Gold will vary from Bitcoin because the chains are mined independently and although the schedule is the same each block time is different.<br><br>Bitcoin Gold is available on <a href="https://www.binance.com/en/register?ref=QKMBZ7IE" target="_blank" rel="nofollow">Binance</a>.`;
        } else if (sym === 'xzc') {
        additionalText = `<h4>Note that Zcoin has now rebranded to Firo</h4>`;
      } else if (sym === 'xvg') {
        additionalText = `Verge is a cryptocurrency "designed for everyday use" according to the official website at <a href="https://vergecurrency.com/">Vergecurrency.com</a>. It is an open-source community driven project that includes the popular vergePay wallet. Verge has a faster halving schedule than many other cryptocurrencies because of the quick block times.
        <h4>Verge Halving Dates</h4>
        <table class="tbl tbl-bitcoin">
          <tr><th>Estimated Date</th><th>Block No.</th><th>Mining Reward</th></tr>
          <tr><td>December 2019</td><td>3,700,000</td><td>400 XVG</td></tr>
          <tr><td>July 2020</td><td>4,200,000</td><td>200 XVG</td></tr>
          <tr><td>January 2021</td><td>4,700,000</td><td>100 XVG</td></tr>
          <tr><td>September 2021</td><td>5,200,000</td><td>50 XVG</td></tr>
          <tr><td>April 2022</td><td>5,700,000</td><td>25 XVG</td></tr>
          <tr><td>October 2022</td><td>6,200,000</td><td>12.5 XVG</td></tr>
          <tr><td>May 2023</td><td>6,700,000</td><td>6.25 XVG</td></tr>
        </table>
        <br><br>Verge is available on <a href="https://www.binance.com/en/register?ref=QKMBZ7IE" target="_blank" rel="nofollow">Binance</a>.`;
      } else if (sym === 'rvn') {
        additionalText = `<p>Ravencoin is designed specifically to handle the digital transfer of assets. The Ravencoin project uses a blockchain and P2P network which was originally forked from the Bitcoin source code on January 3rd 2018.</p>
        <p>The project is truly open-source and contributors are welcome. The Ravencoin project never carried out an ICO, did not set aside founder/dev funds and does not self-fund through masternodes.</p>
        <p>During the fork the RVN team implemented a number of significant features:-
        <ul>
        <li>The coin supply was increased 1000x from 21 million to 21 billion.</li>
        <li>Mining algorithm was changed to an X16 variante to encourage GPU competitiveness, later changed to KAWPOW algo.</li>
        <li>Blocktime was reduced to 60 seconds.</li>
        <li>Block reward was changed to 5000 RVN Tokens</li>
        </ul>
        </p>
        <p>Ravencoin is available on <a href="https://www.binance.com/en/register?ref=QKMBZ7IE" target="_blank" rel="nofollow">Binance</a>.</p>`;
      } else if (sym === 'vtc') {
        additionalText = `<p>Vertcoin is a GPU mined blockchain that was started in January 2014. The developers felt that ASIC dominance of litecoin was bad for decentralization and wanted to make an ASIC resistant fork. The source code was forked originally from Bitcoin and updates to the Bitcoin main chain are still rolled out to Vertcoin as well.</p>
        <p>The supply (84m) and block time (2.5min) are taken from Litecoin specs to enable improvements to scalability. The mining algorithm is Verthash which is similar to Ethash and is designed to be ASIC resistant and mined by GPU miners. The difficulty adjustment is processed every 2.5 minutes as opposed to every two weeks with BTC.</p>
        <p>There was no pre-mine, ICO or airdrop when Vertcoin forked the project is not funded or controlled by any single organisation. The project is open-source and decentralised.</p>`;
      } else {
        const comparedToBTC = Math.round((inf[sym].halvingTime - inf.btc.halvingTime) / 86400000);
        let beforeAfterBTC = `${comparedToBTC.toString().split(/[^0-9]/).join('')} before`;
        if (comparedToBTC > 0) beforeAfterBTC = `${comparedToBTC} after`;
        additionalText = `This is expected to take place ${beforeAfterBTC} the Bitcoin halving.`;
      }
      document.getElementById('additional-text').innerHTML = additionalText;

      let table = `<table class="tbl tbl-halving-dates"><tr><th>Symbol</th><th>Cryptocurrency</th><th class="hide-mobile">Halving Date</th></tr>`;
      Object.keys(inf).forEach((sym) => {
        const halvingDate = new Date(nowTS + inf[sym].halvingTime).toUTCString().substr(0,22);
        table += `<tr onclick="window.location='crypto.php?sym=${sym}&name=${encodeURIComponent(inf[sym].name)}';"><td><div><img src="img/icons/${sym}.png" loading="lazy" class="crypto-icon" alt="${sym.toUpperCase()}" /></div></td><td><a href="crypto.php?sym=${sym}&name=${encodeURIComponent(inf[sym].name)}">${inf[sym].name}</a></td><td>${halvingDate}</td></tr>`;
      });
      table += `</table>`;
      document.getElementById('sub-halving-table').innerHTML = table;
    });
  </script>
</body>
</html>