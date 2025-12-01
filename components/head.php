<?php
if (isset($title) && isset($description)) {
  // do nothing
} else if (isset($_GET['sym']) && $_GET['sym'] == 'btc') {
  $title = 'When is Bitcoin Halving | A Definitive Guide';
  $description = 'Everything the experts do not want you to know about the Bitcoin (BTC) halving or halvening';
} else if (isset($_GET['sym']) && $_GET['sym'] == 'mona') {
  $title = 'The Monacoin Halving Explained | Ultimate Guide';
  $description = 'How the Monacoin halving or halvening works and what the effects are likely to be for traders, users and hodlers';
} else if (isset($_GET['sym']) && $_GET['sym'] == 'zec') {
  $title = 'Zcash Halving | Everything You Need To Know';
  $description = 'The halving will happen in 2020, rewards will drop to 6.25 ZEC and the founders reward will be eliminated';
} else if (isset($_GET['sym']) && isset($_GET['name'])) {
  $title = $_GET['name'].' Halving ('.$_GET['sym'].') | Dates, Details, Countdown | HalvingDates.com';
  $description = $_GET['name']+'Halving dates, countdownt and information for  ('.$_GET['sym'].'). '.$_GET['name'].' mining supply will be reduced in half '.$_GET['sym'];
} else {
  $title = 'Cryptocurrency Halving Dates | HalvingDates.com';
  $description = 'Halving (halvening) dates, countdowns and details for all cryptocurrencies with a halving event including bitcoin, litecoin, verge, and zcash.';
}
?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,700&display=swap" rel="stylesheet">
  <link href="css/style.css?v=1.0.3" rel="stylesheet">
  <link rel="shortcut icon" href="img/icon.png"> 
  <script type="text/javascript" src="js/script.js?v=1.0.3"></script>
  <title><?php echo $title; ?></title>
  <meta name="description" content="<?php echo $description; ?>">
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="0">
  <script data-ad-client="ca-pub-7452885367396051" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-48537439-19"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-48537439-19');
    gtag('config', 'AW-798029816');
  </script>
</head>