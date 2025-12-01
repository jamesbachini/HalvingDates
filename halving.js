const axios = require('axios');
const cheerio = require('cheerio')
const fs = require('fs');
const halving = require('./data/halving.json');
const date = new Date();
const https = require('https');

console.log('Halving v1.0.4');

const axiosAgent = new https.Agent({  
 rejectUnauthorized: false
});

const getBTC = async () => {
	return new Promise(resolve => {
		axios.get('https://api.blockcypher.com/v1/btc/main',{ httpsAgent: axiosAgent }).then((response) => {
			const name = 'Bitcoin';
      const blockTime = 10 * 60 * 1000;
      const blockHeight = parseInt(response.data.height);
      if(!blockHeight) console.log('blockHeight error: Bitcoin');
      let halvingBlock = 840000;
      if (blockHeight > halvingBlock) halvingBlock += 210000;
      if (blockHeight > halvingBlock) halvingBlock += 210000;
      const halvingTime = (halvingBlock - blockHeight) * blockTime;
			resolve({ name, blockTime, blockHeight, halvingBlock, halvingTime });
		}).catch((error) => {
      console.log('Axios Error', error);
      resolve(false);
    });
	});
};

const getLTC = async () => {
	return new Promise(resolve => {
		axios.get('https://api.blockcypher.com/v1/ltc/main',{ httpsAgent: axiosAgent }).then((response) => {
      const name = 'Litecoin';
			const blockTime = 2.5 * 60 * 1000;
      const blockHeight = parseInt(response.data.height);
      if(!blockHeight) console.log('blockHeight error: Litecoin');
      let halvingBlock = 2500000;
      if (blockHeight > halvingBlock) halvingBlock += 210000;
      if (blockHeight > halvingBlock) halvingBlock += 210000;
      const halvingTime = (halvingBlock - blockHeight) * blockTime;
			resolve({ name, blockTime, blockHeight, halvingBlock, halvingTime });
		}).catch((error) => {
      console.log('Axios Error', error);
      resolve(false);
    });
	});
};

const getBTG = async () => {
	return new Promise(resolve => {
		axios.get('https://btgexplorer.com/api/blocks?limit=1',{ httpsAgent: axiosAgent }).then((response) => {
      const name = 'Bitcoin Gold';
			const blockTime = 10 * 60 * 1000;
      const blockHeight = parseInt(response.data.blockbook.bestHeight);
      if(!blockHeight) console.log('blockHeight error: Bitcoin Gold');
      let halvingBlock = 840000;
      if (blockHeight > halvingBlock) halvingBlock += 210000;
      const halvingTime = (halvingBlock - blockHeight) * blockTime;
			resolve({ name, blockTime, blockHeight, halvingBlock, halvingTime });
		}).catch((error) => {
      console.log('Axios Error', error);
      resolve(false);
    });
	});
};

const getBCH = async () => {
	return new Promise(resolve => {
		axios.get('https://api.blockchair.com/bitcoin-cash/blocks?s=id%28desc%29&limit=1&offset=0&page=0',{ httpsAgent: axiosAgent }).then((response) => {
      const name = 'Bitcoin Cash';
			const blockTime = 10 * 60 * 1000;
      const blockHeight = parseInt(response.data.data[0].id);
      if(!blockHeight) console.log('blockHeight error: Bitcoin Cash');
      let halvingBlock = 840000;
      if (blockHeight > halvingBlock) halvingBlock += 210000;
      if (blockHeight > halvingBlock) halvingBlock += 210000;
      if (blockHeight > halvingBlock) halvingBlock += 210000;
      const halvingTime = (halvingBlock - blockHeight) * blockTime;
			resolve({ name, blockTime, blockHeight, halvingBlock, halvingTime });
		}).catch((error) => {
      console.log('Axios Error', error);
      resolve(false);
    });
	});
};

const getZEC = async () => {
	return new Promise(resolve => {
		axios.get('https://api.blockchair.com/zcash/blocks?s=id%28desc%29&limit=1&offset=0&page=0',{ httpsAgent: axiosAgent }).then((response) => {
      const name = 'Bitcoin Cash';
			const blockTime = 10 * 60 * 1000;
      const blockHeight = parseInt(response.data.data[0].id);
      if(!blockHeight) console.log('blockHeight error: Bitcoin Cash');
      let halvingBlock = 840000;
      if (blockHeight > halvingBlock) halvingBlock += 210000;
      if (blockHeight > halvingBlock) halvingBlock += 210000;
      if (blockHeight > halvingBlock) halvingBlock += 210000;
      const halvingTime = (halvingBlock - blockHeight) * blockTime;
			resolve({ name, blockTime, blockHeight, halvingBlock, halvingTime });
		}).catch((error) => {
      console.log('Axios Error', error);
      resolve(false);
    });
	});
};


const getLatestBlock = async (token) => {
  return new Promise(resolve => {
    let url = false
    //if (token === 'bch') url = 'https://uk.advfn.com/crypto/Bitcoin-Cash-ABC-BCH/fundamentals';
    //if (token === 'btg') url = 'https://uk.advfn.com/crypto/Bitcoin-Gold-BTG/fundamentals';
    if (token === 'rvn') url = 'https://uk.advfn.com/crypto/Ravencoin-RVN/fundamentals';
    if (token === 'mona') url = 'https://uk.advfn.com/crypto/Monacoin-MONA/fundamentals';
    if (token === 'xzc') url = 'https://uk.advfn.com/crypto/ZCoin-XZC/fundamentals';
    if (token === 'vtc') url = 'https://uk.advfn.com/crypto/Vertcoin-VTC/fundamentals';
    if (token === 'emc2') url = 'https://uk.advfn.com/crypto/Einsteinium-EMC2/fundamentals';
    if (url) {
      axios.get(url,{ httpsAgent: axiosAgent }).then((response) => {
        const $ = cheerio.load(response.data);
        const latestBlock = Number($('.page-fundamentals').html().split('Latest Block:')[1].split('</tr>')[0].split(/[^0-9]/).join(''));
        resolve(latestBlock);
      });
    }
  });
};

const getCrypto = async (token) => {
  let blockTime = 10 * 60 * 1000;
  let halvingBlock = 630000
  let name = 'Unknown';
  if (token === 'bch') name = 'Bitcoin Cash';
  if (token === 'bsv') name = 'Bitcoin SV';
  if (token === 'btg') name = 'Bitcoin Gold';
  if (token === 'zec') {
    name = 'Zcash';
    blockTime = 75 * 1000;
    halvingBlock = 1046400;
  }
  if (token === 'rvn') {
    name = 'Ravencoin';
    blockTime = 60 * 1000;
    halvingBlock = 2100000;
  }
  if (token === 'mona') {
    name = 'Monacoin';
    blockTime = 90 * 1000;
    halvingBlock = 2102400;
  }
  if (token === 'xzc') {
    name = 'Firo (Zcoin)';
    blockTime = 600 * 1000;
    halvingBlock = 305000;
  }
  if (token === 'vtc') {
    name = 'Vertcoin';
    blockTime = 150 * 1000;
    halvingBlock = 1680000;
  }
  if (token === 'emc2') {
    name = 'Einsteinium';
    blockTime = 60 * 1000;
    halvingBlock = 5256000;
  }
  const blockHeight = await getLatestBlock(token);
  const halvingTime = (halvingBlock - blockHeight) * blockTime;
  return { name, blockTime, blockHeight, halvingBlock, halvingTime };
}

const getBSV = async () => {
	return new Promise(resolve => {
		axios.get('https://bchsvexplorer.com/api/status?q=getInfo',{ httpsAgent: axiosAgent }).then((response) => {
      const name = 'Bitcoin SV';
			const blockHeight = parseInt(response.data.backend.blocks);
			if(!blockHeight) console.log('blockHeight error: Bitcoin SV');
      const blockTime = 10 * 60 * 1000;
      let halvingBlock = 840000;
      if (blockHeight > halvingBlock) halvingBlock += 210000;
      const halvingTime = (halvingBlock - blockHeight) * blockTime;
			resolve({ name, blockTime, blockHeight, halvingBlock, halvingTime });
		}).catch((error) => {
      console.log('Axios Error', error);
      resolve(false);
    });
	});
};

const getBTM = async () => {
	return new Promise(resolve => {
		axios.get('http://blockmeta.com/api/v3/blocks?page=1&limit=1',{ httpsAgent: axiosAgent }).then((response) => {
      const name = 'Bytom';
			const blockHeight = parseInt(response.data.blocks[0].height);
			if(!blockHeight) console.log('blockHeight error: Bytom');
      const blockTime = 2.5 * 60 * 1000;
      let halvingBlock = 840000
      if (blockHeight > halvingBlock) halvingBlock += 210000;
      const halvingTime = (halvingBlock - blockHeight) * blockTime;
			resolve({ name, blockTime, blockHeight, halvingBlock, halvingTime });
		}).catch((error) => {
      console.log('Axios Error', error);
      resolve(false);
    });
	});
};

const getRVN = async () => {
	return new Promise(resolve => {
		axios.get('https://api.ravencoin.org/api/blocks?limit=1',{ httpsAgent: axiosAgent }).then((response) => {
      const blockHeight = parseInt(response.data.blocks[0].height);
      if(!blockHeight) console.log('blockHeight error: Ravencoin');
      const name = 'Ravencoin';
      const blockTime = 60 * 1000;
      let halvingBlock = 2100000;
      if (blockHeight > halvingBlock) halvingBlock += 210000;
      if (blockHeight > halvingBlock) halvingBlock += 210000;
      const halvingTime = (halvingBlock - blockHeight) * blockTime;
			resolve({ name, blockTime, blockHeight, halvingBlock, halvingTime });
		}).catch((error) => {
      console.log('Axios Error', error);
      resolve(false);
    });
	});
};

const getVTC = async () => {
	return new Promise(resolve => {
		axios.get('https://insight.vertcoin.org/insight-vtc-api/status?q=getInfo',{ httpsAgent: axiosAgent }).then((response) => {
      const blockHeight = parseInt(response.data.info.blocks);
      if(!blockHeight) console.log('blockHeight error: Vertcoin');
      const name = 'Vertcoin';
			const blockTime = 150 * 1000;
      let halvingBlock = 1680000;
      if (blockHeight > halvingBlock) halvingBlock += 840000;
      if (blockHeight > halvingBlock) halvingBlock += 840000;
      if (blockHeight > halvingBlock) halvingBlock += 840000;
      if (blockHeight > halvingBlock) halvingBlock += 840000;
      const halvingTime = (halvingBlock - blockHeight) * blockTime;
			resolve({ name, blockTime, blockHeight, halvingBlock, halvingTime });
		}).catch((error) => {
      console.log('Axios Error', error);
      resolve(false);
    });
	});
};

const getMONA = async () => {
	return new Promise(resolve => {
		axios.get('https://chaintools.mona-coin.de/blocks',{ httpsAgent: axiosAgent }).then((response) => {
      const $ = cheerio.load(response.data);
      const blockHeight = Number($('.table > tbody:nth-child(2) > tr:nth-child(1) > td:nth-child(1) > a:nth-child(1)').text().split(/[^0-9]/).join(''));
      if(!blockHeight) console.log('blockHeight error: Monacoin');
      const name = 'Monacoin';
			const blockTime = 90 * 1000;
      const halvingBlock = 3153400;
      const halvingTime = (halvingBlock - blockHeight) * blockTime;
			resolve({ name, blockTime, blockHeight, halvingBlock, halvingTime });
		}).catch((error) => {
      console.log('Axios Error', error);
      resolve(false);
    });
	});
};


const getXZC = async () => {
	return new Promise(resolve => {
		axios.get('https://explorer.zcoin.io/insight-api-zcoin/status?q=getInfo',{ httpsAgent: axiosAgent }).then((response) => {
      const blockHeight = parseInt(response.data.info.blocks);
      if(!blockHeight) console.log('blockHeight error: Zcoin');
      const name = 'Zcoin';
      const blockTime = 600 * 1000;
      const halvingBlock = 305000;
      const halvingTime = (halvingBlock - blockHeight) * blockTime;
			resolve({ name, blockTime, blockHeight, halvingBlock, halvingTime });
		}).catch((error) => {
      console.log('Axios Error', error);
      resolve(false);
    });
	});
};

const start = async () => {
  try {
    halving.btc = await getBTC();
  } catch(err) {
    console.log('Caught error btc',err);
  }
  try {
    halving.ltc = await getLTC();
  } catch(err) {
    console.log('Caught error ltc',err);
  }
  try {
    halving.bch = await getBCH();
  } catch(err) {
    console.log('Caught error bch',err);
  }
  try {
    halving.zec = await getZEC();
  } catch(err) {
    console.log('Caught error zec',err);
  }
  try {
    halving.btg = await getBTG();
  } catch(err) {
    console.log('Caught error btg',err);
  }
  try {
    halving.bcd = await getBCD();
  } catch(err) {
    console.log('Caught error bcd',err);
  }
  try {
    halving.btm = await getBTM();
  } catch(err) {
    console.log('Caught error btm',err);
  }
  try {
    halving.mona = await getMONA();
  } catch(err) {
    console.log('Caught error mona',err);
  }
  try {
    halving.xvg = await getXVG();
  } catch(err) {
    console.log('Caught error xvg',err);
  }
  try {
    halving.xzc = await getXZC();
  } catch(err) {
    console.log('Caught error xzc',err);
  }
  try {
    halving.vtc = await getVTC();
  } catch(err) {
    console.log('Caught error vtc',err);
  }
  try {
    halving.emc2 = await getCrypto('emc2');
  } catch(err) {
    console.log('Caught err gor',err);
  }

  Object.keys(halving).forEach((token) => {
    console.log(`${token} - ${Math.round(halving[token].halvingTime/86400000)} days`);
  });

	const yymmdd = date.toISOString().slice(2,10).replace(/-/g,"");
	const bkupFile = `./data/halving-${yymmdd}.json`;
	const mainFile = `./data/halving.json`;
	fs.writeFileSync(bkupFile, JSON.stringify(halving));
	fs.writeFileSync(mainFile, JSON.stringify(halving));
};

process.on('uncaughtException', function(err) {
  console.log('UnCaught Exception 1062: ' + err);
  console.error(err.stack);
});

process.on('unhandledRejection', (reason, p) => {
  console.log('Unhandled Exception 1068: '+p+' - reason: '+reason);
});

start();
