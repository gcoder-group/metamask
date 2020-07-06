<html>

<head>
  <meta charset="UTF-8">
  <title></title>
  <link rel="icon" type="image/png" href="metamask-fox.svg">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.14.1/css/mdb.min.css" rel="stylesheet">
  
</head>

<body>
<button class="enableEthereumButton">Enable Ethereum</button>
<h2>Account: <span class="showAccount"></span></h2>
<h2>ETH Balance: <span class="showETHBalance"></span></h2>
<h2>ETH Token Balance: <span class="showETHTokenBalance"></span></h2>
<h2>Network Name: <span class="showNetwork"></span></h2>

<br />

<button class="checkEthBalanceButton btn">Check Eth Balance</button>
<button class="checkEthTokenBalanceButton btn">Check Eth Token Balance</button>
<button class="sendEthButton btn">Send Eth</button>
<button class="sendTokenButton btn">Send Token</button>

<script src="./jquery.js"></script>
<!--script src="./bn.js"></script-->
<script src="./web3.min.js"></script>
<script>


$('document').ready(function(){
	// isMetaMask = window.ethereum.isMetaMask
	
	// if(!isMetaMask){
		// alert('Metamask is not available');
		// return false;
	// }
	
	if (typeof window.ethereum !== 'undefined') { 
		
		
	}else{
		alert('Error: Metamask not found!');
	}
	
	
	/* deal with it */ 
	
	const provider = window['ethereum'];
	let web3 = new Web3(Web3.givenProvider);
	// let web3 = new Web3(ethereum);
	// let bn = new BN();
	
	const ethereumButton = document.querySelector('.enableEthereumButton');
	const showAccount = document.querySelector('.showAccount');
	const showETHBalance = document.querySelector('.showETHBalance');
	const showETHTokenBalance = document.querySelector('.showETHTokenBalance');
	
	const checkEthBalanceButton = document.querySelector('.checkEthBalanceButton');
	const checkEthTokenBalanceButton = document.querySelector('.checkEthTokenBalanceButton');
	const showNetwork = document.querySelector('.showNetwork');
	const sendEthButton = document.querySelector('.sendEthButton');
	const sendTokenButton = document.querySelector('.sendTokenButton');
	let accounts = [];

	ethereumButton.addEventListener('click', () => {
	  getAccount();
	});
	var networks = {
		'1': 'Ethereum Main Network',
		'2': 'Morden Test network',
		'3': 'Ropsten Test Network',
		'4': 'Rinkeby Test Network',
		'5': 'Goerli Test Network',
		'42': 'Kovan Test Network'
	}
	async function getAccount() {
	  accounts = await ethereum.enable();
	  const account = accounts[0];
	  showAccount.innerHTML = account;
	  
	  currentNetwork = ethereum.networkVersion;
	  networkname = networks[currentNetwork];
	  showNetwork.innerHTML = networkname;
	}
	
	
	
	function get_current_address(){
		return ethereum.selectedAddress;
	}
	// console.log(ethereum.selectedAddress)
	
	//Account change event
	ethereum.on('accountsChanged', function (accounts) {
	  // Time to reload your interface with accounts[0]!
	  const account = accounts[0];
	  showAccount.innerHTML = account;
	});
	
	//Account change event
	ethereum.on('networkChanged', function (networkVersion) {
		currentNetwork = ethereum.networkVersion;
		networkname = networks[currentNetwork];
		showNetwork.innerHTML = networkname;
		
		showAccount.innerHTML = ethereum.selectedAddress;
	});
	
	ethereum.on('chainChanged', function (chainId) {
	  // Time to make sure your any calls are directed to the correct chain!
	  console.log('Chain changed ',chainId)
	});
	
	
	//Sending Ethereum to an address
	sendEthButton.addEventListener('click', () => {
		
		transfer_bal = '0.000001';
		WeiValue = web3.utils.toWei(transfer_bal,'ether');
		value = web3.utils.toHex(WeiValue);
		
		gasLimit = web3.utils.toHex(800000);
		gasPrice = web3.utils.toHex(web3.utils.toWei('10','gwei'));
	
		ethereum.sendAsync(
		{
		  method: 'eth_sendTransaction',
		  params: [
			{
			  from: accounts[0],
			  to: '0x81F472d5987B7d8d143BC46cB1960c9C7eE9e612',
			  value: value,
			  gasPrice: gasPrice,
			  gas: gasLimit,
			  chainId: 1,
			}
		  ],
		},
		(err, result) => {
			if (err){
				console.log('error');
				console.error(err);
				alert(err.message)
			}
			else{
				console.log('result');
				console.log(result);
				var message = 'Your transaction '+result.result+'has been broadcasted on network.It will take some time to confirm.';
				alert(message);
			}
		}
	  );
	});
	
	
	//Sending Ethereum to an address
	sendTokenButton.addEventListener('click', () => {
		
		
		
		
		const contractAbi =  [{"constant":true,"inputs":[],"name":"name","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"spender","type":"address"},{"name":"tokens","type":"uint256"}],"name":"approve","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"from","type":"address"},{"name":"to","type":"address"},{"name":"tokens","type":"uint256"}],"name":"transferFrom","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_from","type":"address"}],"name":"BurnToken","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"tokenOwner","type":"address"}],"name":"balanceOf","outputs":[{"name":"balance","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"acceptOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"to","type":"address"},{"name":"tokens","type":"uint256"}],"name":"transfer","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"spender","type":"address"},{"name":"tokens","type":"uint256"},{"name":"data","type":"bytes"}],"name":"approveAndCall","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"newOwner","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"tokenAddress","type":"address"},{"name":"tokens","type":"uint256"}],"name":"transferAnyERC20Token","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"tokenOwner","type":"address"},{"name":"spender","type":"address"}],"name":"allowance","outputs":[{"name":"remaining","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"payable":true,"stateMutability":"payable","type":"fallback"},{"anonymous":false,"inputs":[{"indexed":true,"name":"_from","type":"address"},{"indexed":true,"name":"_to","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"},{"indexed":false,"name":"tokens","type":"uint256"}],"name":"Transfer","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"tokenOwner","type":"address"},{"indexed":true,"name":"spender","type":"address"},{"indexed":false,"name":"tokens","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":false,"name":"value","type":"uint256"}],"name":"Burn","type":"event"}];
		
		const contractAbiBAC = [{"constant":true,"inputs":[],"name":"name","outputs":[{"name":"","type":"string"}],"payable":false,"type":"function"},{"constant":false,"inputs":[{"name":"_spender","type":"address"},{"name":"_value","type":"uint256"}],"name":"approve","outputs":[],"payable":false,"type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"name":"","type":"uint256"}],"payable":false,"type":"function"},{"constant":false,"inputs":[{"name":"_from","type":"address"},{"name":"_to","type":"address"},{"name":"_value","type":"uint256"}],"name":"transferFrom","outputs":[],"payable":false,"type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"name":"","type":"uint256"}],"payable":false,"type":"function"},{"constant":true,"inputs":[],"name":"version","outputs":[{"name":"","type":"string"}],"payable":false,"type":"function"},{"constant":true,"inputs":[],"name":"saleStarted","outputs":[{"name":"","type":"bool"}],"payable":false,"type":"function"},{"constant":true,"inputs":[],"name":"issueIndex","outputs":[{"name":"","type":"uint256"}],"payable":false,"type":"function"},{"constant":true,"inputs":[{"name":"_owner","type":"address"}],"name":"balanceOf","outputs":[{"name":"balance","type":"uint256"}],"payable":false,"type":"function"},{"constant":true,"inputs":[],"name":"saleOrNot","outputs":[{"name":"","type":"bool"}],"payable":false,"type":"function"},{"constant":false,"inputs":[],"name":"destroy","outputs":[],"payable":false,"type":"function"},{"constant":false,"inputs":[{"name":"recipient","type":"address"}],"name":"issueToken","outputs":[],"payable":true,"type":"function"},{"constant":false,"inputs":[{"name":"_price","type":"uint256"}],"name":"setPrice","outputs":[],"payable":false,"type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"name":"","type":"string"}],"payable":false,"type":"function"},{"constant":true,"inputs":[],"name":"price","outputs":[{"name":"","type":"uint256"}],"payable":false,"type":"function"},{"constant":false,"inputs":[{"name":"_to","type":"address"},{"name":"_value","type":"uint256"}],"name":"transfer","outputs":[],"payable":false,"type":"function"},{"constant":true,"inputs":[],"name":"bacFund","outputs":[{"name":"","type":"uint256"}],"payable":false,"type":"function"},{"constant":true,"inputs":[],"name":"MaxReleasedBac","outputs":[{"name":"","type":"uint256"}],"payable":false,"type":"function"},{"constant":false,"inputs":[],"name":"startSale","outputs":[],"payable":false,"type":"function"},{"constant":true,"inputs":[],"name":"target","outputs":[{"name":"","type":"address"}],"payable":false,"type":"function"},{"constant":true,"inputs":[{"name":"_owner","type":"address"},{"name":"_spender","type":"address"}],"name":"allowance","outputs":[{"name":"remaining","type":"uint256"}],"payable":false,"type":"function"},{"constant":false,"inputs":[],"name":"stopSale","outputs":[],"payable":false,"type":"function"},{"inputs":[{"name":"_price","type":"uint256"}],"payable":false,"type":"constructor"},{"payable":true,"type":"fallback"},{"anonymous":false,"inputs":[{"indexed":false,"name":"caller","type":"address"}],"name":"InvalidCaller","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"issueIndex","type":"uint256"},{"indexed":false,"name":"addr","type":"address"},{"indexed":false,"name":"ethAmount","type":"uint256"},{"indexed":false,"name":"tokenAmount","type":"uint256"}],"name":"Issue","type":"event"},{"anonymous":false,"inputs":[],"name":"StartOK","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"msg","type":"bytes"}],"name":"InvalidState","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"msg","type":"bytes"}],"name":"ShowMsg","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"owner","type":"address"},{"indexed":true,"name":"spender","type":"address"},{"indexed":false,"name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"},{"indexed":false,"name":"value","type":"uint256"}],"name":"Transfer","type":"event"}];
		
		const contractAddr = '0x3861086e624ee69846d2b1fbb18827aab6896169'
		const contractAddrBAC = '0xc3e6e8a5181505184C3B5550beaAE686ec8b36FB'
		
		var to = '0x81F472d5987B7d8d143BC46cB1960c9C7eE9e612';
		var isValidAddress = web3.utils.isAddress(to);
		
		if(isValidAddress == false){
			alert('To address is not valid');
			return false;
		}
		
		
		var fees = 0.001;
		
		// const contract = new web3.eth.Contract(contractAbi,contractAddr)
		const contract = new web3.eth.Contract(contractAbi,contractAddr)
		fromAddress = ethereum.selectedAddress
		
		var input_token = 1;
		var tokens_ = input_token*Math.pow(10, 18); 
		tokens_ = (tokens_).toFixedSpecial(0);
		
		//checking the token balance
		contract.methods.balanceOf(fromAddress).call({},(err,result)=>{
			if(err) {return false;}
			
			var tokenBalance = result;
			if(tokenBalance <= tokens_){
				console.log('insufficient fund!');
				alert('Insufficient Token');
				return false;
			}
			
			
			var balance= 0;
			web3.eth.getBalance(fromAddress,(err,bal)=>{
				if(err){
					console.log('err'+err);
					return;
				}
				balance = bal;
				eth_balance = web3.utils.fromWei(balance,'ether');
				
				if(eth_balance < fees){
					console.log('insufficient Network Fees!');
					alert('insufficient Network Fees!');
					return false;
				}
				
				const tokens = web3.utils.toHex(tokens_);
				const data = contract.methods.transfer(to,tokens).encodeABI();
				
				web3.eth.getTransactionCount(ethereum.selectedAddress,(err,txCount)=>{
					contractData = data;
					contractAddress = contractAddr;
					fromAddress = ethereum.selectedAddress
					const transactionObject = {
						nonce: web3.utils.toHex(txCount),
						gasPrice: web3.utils.toHex(web3.utils.toWei('10','gwei')),
						gasLimit: web3.utils.toHex(100000),
						data: contractData,
						to: contractAddress,
						chainId: 3,
						from: fromAddress,
					}
					web3.eth.sendTransaction(transactionObject,(err,result)=>{
						console.log(err)
						console.log(result)
					}).then((receipt)=>{
						console.log(receipt);
					});		
					
					
				});
			
				
			}).then(()=>{

			}).catch(error => {
			   console.log("something bad happened somewhere, rollback!");
			   console.log(error);
			  
			});
			
			
		})
		.catch(error => {
		   console.log('balance of catch error');
		   console.log(error);
		   
		   return false;
		});
		
		
		
	});
	
	function getTransactionStatus(){
		// txHash = '0x3d17870b2fdd911cff3185def04787d148e352d9d05653f3bdcd23d65bd07f6e';
		txHash = '0x5e7bf25813dac2b2d5568345f672eb6ec6d630babc3ead2417098c84cf50294b';
		const receipt = web3.eth.getTransactionReceipt(txHash)
		.then((res)=>{ 
			if(res == null) console.log('txHash not found!');
			else console.log(res); 
		}, (error)=>{ 
			console.log(error); 
		});
	}
	
	getTransactionStatus();
	
	/* Get Eth balance */
	checkEthBalanceButton.addEventListener('click', () => {
	
		var address = ethereum.selectedAddress;
		
		
		var balance= 0;
		web3.eth.getBalance(address,(err,bal)=>{
			if(err){
				console.log('err'+err);
				return;
			}
			balance = bal;
			eth_balance = web3.utils.fromWei(balance,'ether');
			console.log('balance - '+eth_balance);
			showETHBalance.innerHTML = eth_balance;
		}).then(()=>{

		}).catch(error => {
		   console.log("something bad happened somewhere, rollback!");
		   console.log(error);
		  
		});
	 
	

	});
	
	
	/* Get Eth Token balance */
	checkEthTokenBalanceButton.addEventListener('click', () => {
		//getting the token balance 
		const contractAbi =  [{"constant":true,"inputs":[],"name":"name","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"spender","type":"address"},{"name":"tokens","type":"uint256"}],"name":"approve","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"from","type":"address"},{"name":"to","type":"address"},{"name":"tokens","type":"uint256"}],"name":"transferFrom","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_from","type":"address"}],"name":"BurnToken","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"tokenOwner","type":"address"}],"name":"balanceOf","outputs":[{"name":"balance","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"acceptOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"to","type":"address"},{"name":"tokens","type":"uint256"}],"name":"transfer","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"spender","type":"address"},{"name":"tokens","type":"uint256"},{"name":"data","type":"bytes"}],"name":"approveAndCall","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"newOwner","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"tokenAddress","type":"address"},{"name":"tokens","type":"uint256"}],"name":"transferAnyERC20Token","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"tokenOwner","type":"address"},{"name":"spender","type":"address"}],"name":"allowance","outputs":[{"name":"remaining","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"payable":true,"stateMutability":"payable","type":"fallback"},{"anonymous":false,"inputs":[{"indexed":true,"name":"_from","type":"address"},{"indexed":true,"name":"_to","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"},{"indexed":false,"name":"tokens","type":"uint256"}],"name":"Transfer","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"tokenOwner","type":"address"},{"indexed":true,"name":"spender","type":"address"},{"indexed":false,"name":"tokens","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":false,"name":"value","type":"uint256"}],"name":"Burn","type":"event"}];
		
		const contractAddr = '0x3861086e624ee69846d2b1fbb18827aab6896169'
		const contract = new web3.eth.Contract(contractAbi,contractAddr)
		fromAddress = ethereum.selectedAddress;;
		contract.methods.balanceOf(fromAddress).call({},(err,result)=>{
			if(err) {return false;}

			var tokenBalance = result;
			tokenBalance = result/Math.pow(10, 18);
			showETHTokenBalance.innerHTML = tokenBalance;
			
		})
		.catch(error => {
		   console.log('balance of catch error');
		   console.log(error);
		   
		   return false;
		});
		
	 
	

	});
	
});



function addToken(){
		const tokenAddress = '0xd00981105e61274c8a5cd5a88fe7e037d935b513';
		const tokenSymbol = 'TUT';
		const tokenDecimals = 18;
		const tokenImage = 'http://placekitten.com/200/300';

		ethereum.sendAsync(
		  {
			method: 'wallet_watchAsset',
			params: {
			  type: 'ERC20',
			  options: {
				address: tokenAddress,
				symbol: tokenSymbol,
				decimals: tokenDecimals,
				image: tokenImage,
			  },
			},
			id: Math.round(Math.random() * 100000),
		  },
		  (err, added) => {
			if (added) {
			  console.log('Thanks for your interest!');
			} else {
			  console.log('Your loss!');
			}
		  }
	  );
	}

Number.prototype.toFixedSpecial = function(n) {
  var str = this.toFixed(n);
  if (str.indexOf('e+') === -1)
    return str;

  // if number is in scientific notation, pick (b)ase and (p)ower
  str = str.replace('.', '').split('e+').reduce(function(p, b) {
    return p + Array(b - p.length + 2).join(0);
  });
  
  if (n > 0)
    str += '.' + Array(n + 1).join(0);
  
  return str;
};


</script>
</body>

</html>