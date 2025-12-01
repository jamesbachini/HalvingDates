<!DOCTYPE html>
<html lang="en">
<?php include('components/head.php'); ?>
<body>
  <?php include('components/topbar.php'); ?>
  <div class="content">
    <div class="container">
      <h1>Cryptocurrency Halving Dates</h1>
      <hr>
      <p>Many cryptocurrencies, including Bitcoin, have a fixed supply and achieve this by halving the mining rewards at regular intervals. This reduces the distribution of coins affecting supply and demand for the cryptocurrency.</p>
      <p>The previous halving for Bitcoin happened on April 19th 2024 and it will happen again in 2028 etc. However it's not just Bitcoin that has a halvening event. Check out the cryptocurrencies below and their halving dates.</p>
      <div id="halving-table">
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
      </div>
      <h4>Next Coin To Be Halved: <span id="next-halved"></span></h4>
      <h4><span class="year"></span> Halvings: <span id="year-halved"></span></h4>
      <h2>Bitcoin Halving</h2>
      <div id="btc-timer" class="timer">
        <ul>
          <li><span id="btc-days">0</span>Days</li>
          <li><span id="btc-hours">0</span>Hours</li>
          <li><span id="btc-minutes">0</span>Mins</li>
          <li><span id="btc-seconds">0</span>Secs</li>
        </ul>
      </div>

      <h2>How Halvings Work</h2> 
      <p>Bitcoin and other cryptocurrencies distribute their digital coins via miners who contribute processing power to the network. Bitcoin has a limited supply of 21 million bitcoins which means that it is not possible to provide mining rewards forever. Every 210,000 blocks in the blockchain (which takes about four years @ 10 minutes per block) the mining reward is cut in half. This is coded into the distributed software known as a node. All the miners use the same node software which includes a fixed schedule of diminishing mining rewards. The first halving happened in November 2012 when the initial supply was cut from 50 BTC per block to 25 BTC.</p>

      <img src="img/bitcoin-halving.png" class="responsive-image" alt="bitcoin halving" />

      <p>Cryptocurrency operates through a process involving "blocks" of transactions, verified by miners who are subsequently rewarded with new coins. This process introduces new coins into circulation and serves as an incentive for miners.</p>
      <p>One crucial element of certain cryptocurrencies is the "halving" mechanism, which takes place periodically, reducing the rewards miners receive, and in turn, slowing down the rate at which new coins are created. This reduction essentially restricts the supply of available coins, leading to digital scarcity.</p>
      <p>Digital scarcity is a significant trait that differentiates these cryptocurrencies from traditional currencies, which can inflate their supply based on economic needs. By maintaining a limit on their quantity, these cryptocurrencies ensure predictability and uphold transparency.</p>
      <p>The concept of digital scarcity is attractive due to its connection with the principles of supply and demand. It posits that if the availability of a resource decreases, given a constant demand, the value of the said resource should naturally increase. Although the demand factors for these cryptocurrencies are complex, the supply is entirely predictable and continuously shrinking.</p>
      <p>However, it's important to note that halving events might also impact the security of the cryptocurrency network. As rewards decrease, miners, particularly smaller ones, might find their operations no longer worthwhile, potentially rendering the network vulnerable. Nevertheless, rising prices due to scarcity could also increase the profitability for miners, encouraging them to remain active. </p>
      
      <h2>How do halvings affect the price?</h2>

      <p>Price is determined by supply and demand on 3rd party exchanges where digital assets are traded. Halvings effectively cut the supply in half which over the long-term should cause a price increase as there is less supply entering the market. However halvings are often used as an event for high volume margin trading which can cause exceptionally high volatility.</p>

      <p>So far we have seen Bitcoin follow a four year market cycle where the price appreciates after each halving event. Note that there are too few data points to accurately model this into the future and past performance is not an indicator of future returns</p>

      <p>This is a chart which shows the price inflation after the previous halvening in 2016 when Bitcoin was priced at $654 USD.</p>

      <img src="img/bitcoin-halving-price.png" class="responsive-image" alt="bitcoin halving price" />

      <p>So what will happen during the next halvening? Noone really knows but Greyscale associates offer this assessment.</p>

      <p><i>“For investors with a multi-year investment horizon and a high-risk tolerance, the confluence of discounted prices, improving network fundamentals, strong relative investment activity and the upcoming halving may offer an attractive entry point into Bitcoin.”</i></p>

      <h2>How is mining affected?</h2>

      <p>Miners are fully aware of upcoming halvings and are able to plan ahead with their equipment purchases. As mining rewards have halved in the past the value to USD and other fiat currencies has risen enabling miners to operate profitably and continue providing the processing power to secure the blockchain. Eventually transaction fees will play a bigger role than mining rewards for the miners as halvings and increased transactions from higher adoption adjust the earnings ratios.</p>

      <h2>Where can I buy Bitcoin?</h2>

      <p>You can purchase Bitcoin from <a href="https://www.coinbase.com/join/bachin_sq" target="_blank" rel="nofollow">Coinbase</a> if you are based in one of the following countries:-</p>
      <p style="font-size: 11px;">Andorra, Angola, Argentina, Armenia, Aruba, Australia, Austria, Bahamas, Bahrain, Barbados, Belgium, Benin, Bermuda, Botswana, Brazil, Brunei Darussalam, Bulgaria, Cameroon, Canada, Chile, Colombia, Costa Rica, Croatia, Curaçao, Cyprus, Czech Republic, Denmark, Dominican Republic, Ecuador, El Salvador, Estonia, Finland, France, Ghana, Gibraltar, Greece, Guatemala, Guernsey, Honduras, Hong Kong, Hungary, Iceland, India, Indonesia, Ireland, Isle of Man, Italy, Jamaica, Jersey, Jordan, Kazakhstan, Kenya, Korea, Republic of, Kuwait, Kyrgyzstan, Latvia, Liechtenstein, Lithuania, Luxembourg, Macao, Maldives, Malta, Mauritius, Mexico, Monaco, Mongolia, Montenegro, Namibia, Nepal, Netherlands, New Zealand, Nicaragua, Norway, Oman, Panama, Paraguay, Peru, Philippines, Poland, Portugal, Romania, Rwanda, San Marino, Serbia, Singapore, Slovakia, Slovenia, South Africa, South America, Spain, Sweden, Switzerland, Taiwan, Trinidad and Tobago, Tunisia, Turkey, Uganda, United Kingdom, United States, Uruguay, Uzbekistan, Virgin Islands, British, Zambia</p>




      <p>*All dates are estimated using current and expected block completion times.</p>
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
      const yearHalved = [];
      let nextHalved = { name: 'Bitcoin', halvingTime: 999999999999999999999999 };
      let table = `<table class="tbl tbl-halving-dates"><tr><th>Symbol</th><th>Cryptocurrency</th><th class="hide-mobile">Halving Date</th><th class="hide-mobile">Current Block</th><th>Halving Block</th></tr>`;
      Object.keys(inf).forEach((sym) => {
        const halvingDate = new Date(nowTS + inf[sym].halvingTime).toUTCString().substr(0,22);
        table += `<tr onclick="window.location='crypto.php?sym=${sym}&name=${encodeURIComponent(inf[sym].name)}';"><td><div><img src="img/icons/${sym}.png" loading="lazy" class="crypto-icon" alt="${sym.toUpperCase()}" /></div></td><td><a href="crypto.php?sym=${sym}&name=${encodeURIComponent(inf[sym].name)}">${inf[sym].name}</a></td><td>${halvingDate}</td><td class="hide-mobile">${inf[sym].blockHeight}</td><td class="hide-mobile">${inf[sym].halvingBlock}</td></tr>`;
        if (inf[sym].halvingTime > 0 && inf[sym].halvingTime < nextHalved.halvingTime) {
          nextHalved = { name: inf[sym].name, halvingTime: inf[sym].halvingTime};
        }
        if (halvingDate.indexOf(year) > -1) yearHalved.push(sym.toUpperCase());
      });
      table += `</table>`;
      document.getElementById('halving-table').innerHTML = table;
      document.getElementById('next-halved').innerHTML = `${nextHalved.name} in ${Math.round(nextHalved.halvingTime/86400000)} days`;
      document.querySelectorAll('.year').forEach((el) => el.innerHTML = year);
      document.getElementById('year-halved').innerHTML = yearHalved.join(', ');

      // timers
      const btcTimer = setTimer('btc',inf.btc.halvingTime);
      
    });
  </script>
</body>
</html>