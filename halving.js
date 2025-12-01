const axios = require('axios');
const cheerio = require('cheerio')
const fs = require('fs');
const halving = require('./data/halving.json');
const date = new Date();
const https = require('https');

const halvingSchedule = {
	btc: { firstHalvingBlock: 210000, interval: 210000 },
	ltc: { firstHalvingBlock: 840000, interval: 840000 },
	bch: { firstHalvingBlock: 210000, interval: 210000 },
	zec: { firstHalvingBlock: 1046400, interval: 1046400, blockTime: 75 * 1000 },
	btg: { firstHalvingBlock: 210000, interval: 210000 },
	bcd: { firstHalvingBlock: 210000, interval: 210000 },
	btm: { firstHalvingBlock: 840000, interval: 210000 },
	bsv: { firstHalvingBlock: 210000, interval: 210000 },
	mona: { firstHalvingBlock: 1051200, interval: 1051200 },
	xvg: { firstHalvingBlock: 700000, interval: 700000 },
	xzc: { firstHalvingBlock: 305000, interval: 305000 },
	vtc: { firstHalvingBlock: 840000, interval: 840000 },
	emc2: { firstHalvingBlock: 5256000, interval: 5256000 },
	rvn: { firstHalvingBlock: 2100000, interval: 2100000 },
};

console.log('Halving v1.0.4');

const axiosAgent = new https.Agent({  
 rejectUnauthorized: false
});

const getNextHalvingBlock = (token, blockHeight) => {
	const schedule = halvingSchedule[token];
	if (!schedule || !blockHeight) return false;
	let halvingBlock = schedule.firstHalvingBlock;
	while (blockHeight >= halvingBlock) halvingBlock += schedule.interval;
	return halvingBlock;
};

const applySchedule = (token, data) => {
	if (!data || typeof data.blockHeight !== 'number') return data;
	const schedule = halvingSchedule[token];
	if (!schedule) return data;
	const blockTime = schedule.blockTime || data.blockTime;
	const halvingBlock = getNextHalvingBlock(token, data.blockHeight);
	const halvingTime = halvingBlock === false ? data.halvingTime : (halvingBlock - data.blockHeight) * blockTime;
	return { ...data, blockTime, halvingBlock, halvingTime };
};

const getBTC = async () => {
	return new Promise(resolve => {
		axios.get('https://api.blockcypher.com/v1/btc/main',{ httpsAgent: axiosAgent }).then((response) => {
			const name = 'Bitcoin';
			const blockTime = 10 * 60 * 1000;
			const blockHeight = parseInt(response.data.height);
			if(!blockHeight) console.log('blockHeight error: Bitcoin');
      const halvingBlock = getNextHalvingBlock('btc', blockHeight);
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
      const halvingBlock = getNextHalvingBlock('ltc', blockHeight);
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
      const halvingBlock = getNextHalvingBlock('btg', blockHeight);
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
      const halvingBlock = getNextHalvingBlock('bch', blockHeight);
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
      const name = 'Zcash';
			const blockTime = 75 * 1000;
      const blockHeight = parseInt(response.data.data[0].id);
      if(!blockHeight) console.log('blockHeight error: Zcash');
      const halvingBlock = getNextHalvingBlock('zec', blockHeight);
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
		if (url) {
			axios.get(url,{ httpsAgent: axiosAgent }).then((response) => {
				const $ = cheerio.load(response.data);
				const latestBlock = Number($('.page-fundamentals').html().split('Latest Block:')[1].split('</tr>')[0].split(/[^0-9]/).join(''));
				resolve(latestBlock);
			}).catch((error) => {
				console.log('Axios Error', error);
				resolve(false);
			});
		} else {
			resolve(false);
		}
	});
};

const getCrypto = async (token) => {
	let blockTime = 10 * 60 * 1000;
	let name = 'Unknown';
	if (token === 'bch') name = 'Bitcoin Cash';
	if (token === 'bsv') name = 'Bitcoin SV';
	if (token === 'btg') name = 'Bitcoin Gold';
	if (token === 'zec') {
		name = 'Zcash';
		blockTime = 75 * 1000;
	}
	if (token === 'rvn') {
		name = 'Ravencoin';
		blockTime = 60 * 1000;
	}
	if (token === 'mona') {
		name = 'Monacoin';
		blockTime = 90 * 1000;
	}
	if (token === 'xzc') {
		name = 'Firo (Zcoin)';
		blockTime = 600 * 1000;
	}
	if (token === 'vtc') {
		name = 'Vertcoin';
		blockTime = 150 * 1000;
	}
	const blockHeight = await getLatestBlock(token);
	if (!blockHeight) return false;
	const halvingBlock = getNextHalvingBlock(token, blockHeight);
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
      const halvingBlock = getNextHalvingBlock('bsv', blockHeight);
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
      const halvingBlock = getNextHalvingBlock('rvn', blockHeight);
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
      const halvingBlock = getNextHalvingBlock('vtc', blockHeight);
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
      const halvingBlock = getNextHalvingBlock('mona', blockHeight);
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
      const halvingBlock = getNextHalvingBlock('xzc', blockHeight);
      const halvingTime = (halvingBlock - blockHeight) * blockTime;
			resolve({ name, blockTime, blockHeight, halvingBlock, halvingTime });
		}).catch((error) => {
      console.log('Axios Error', error);
      resolve(false);
    });
	});
};

const start = async () => {
	const setHalvingToken = async (token, fn) => {
		if (typeof fn !== 'function') {
			console.log(`No fetcher defined for ${token}, keeping previous values`);
			return;
		}
		try {
			const data = await fn();
			if (data) {
				halving[token] = applySchedule(token, data);
			} else {
				console.log(`No data returned for ${token}, keeping previous values`);
			}
		} catch(err) {
			console.log(`Caught error ${token}`, err);
			console.log(`Keeping previous values for ${token}`);
		}
	};

	await setHalvingToken('btc', getBTC);
	await setHalvingToken('ltc', getLTC);
	await setHalvingToken('bch', getBCH);
	await setHalvingToken('zec', getZEC);
	await setHalvingToken('btg', getBTG);
	await setHalvingToken('mona', getMONA);
	await setHalvingToken('xzc', getXZC);
	await setHalvingToken('vtc', getVTC);

	Object.keys(halving).forEach((token) => {
		if (!halving[token]) return;
		halving[token] = applySchedule(token, halving[token]);
	});

	Object.keys(halving).forEach((token) => {
		const data = halving[token];
		if (!data || typeof data.halvingTime !== 'number' || isNaN(data.halvingTime)) {
			console.log(`${token} - no updated data`);
			return;
		}
		console.log(`${token} - ${Math.round(data.halvingTime/86400000)} days`);
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
