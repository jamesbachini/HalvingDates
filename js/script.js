const toggleMenu = () => {
	const elem = document.getElementById('menu');
  const displayed = elem.currentStyle ? elem.currentStyle.display : window.getComputedStyle ? window.getComputedStyle(elem, null).getPropertyValue('display') : null;
  if (displayed == 'none') {
    elem.style.display = "block";
  } else {
    elem.style.display = "none";
  }
};

const loadJSON = (cb) => {
  fetch('data/halving.json')
  .then(response => response.json())
  .then(json => cb(json));
};

const setTimer = (token,halvingTime) => {
  let countDown = new Date().getTime() + halvingTime;
  const timer = setInterval(() => {
    let now = new Date().getTime();
    let distance = countDown - now;
    document.getElementById(token+'-days').innerText = Math.floor(distance / (86400000)),
    document.getElementById(token+'-hours').innerText = Math.floor((distance % (86400000)) / (3600000)),
    document.getElementById(token+'-minutes').innerText = Math.floor((distance % (3600000)) / (60000)),
    document.getElementById(token+'-seconds').innerText = Math.floor((distance % (60000)) / 1000);
  }, 1000);
  return timer;
};
