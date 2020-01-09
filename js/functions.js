const toggleSearch = document.getElementById("masthead-search-toggle");

function autofocus() {
	if (toggleSearch.getAttribute("checked")) {
		toggleSearch.setAttribute("checked","");
		document.getElementById("header-mobile").style.opacity = "1";
	}
	else {
		toggleSearch.setAttribute("checked","checked");
		document.getElementById("masthead-search-search").focus();
		document.getElementById("header-mobile").style.opacity = ".6";
		
	}
}
 
toggleSearch.addEventListener("change",autofocus);

const selectCoin =  document.getElementById("selectCoin");//los dos select
if (selectCoin) {
	var n = document.getElementsByClassName("priceBook").length;//cantidad de productos
	var cartTitle = document.getElementById("cartTitle");//titulo carrito
	var catalogue = document.getElementById("books-catalogue");//catalogo index
	if (cartTitle) {
		var quantitySelect = document.getElementsByClassName("quan");//selector de cantidad en carrito
		var m = document.getElementsByClassName("quan").length;
	}
	if (catalogue || cartTitle) {
		var small = document.getElementsByClassName("smallCoin");//div de moneda pais
		var priceSign = document.getElementsByClassName("priceSign");//div de signo peso
		var priceBook = new Array();
		for ( let i = 0; i < n; i++) {//llenamos el array con los precios 
			priceBook.push(document.getElementsByClassName("priceBook")[i].innerHTML);
		}
	}
}	

//cambia precios y signos al elegir la moneda nacional
function changeCoin() {
	let coin = selectCoin.value;
	let realPrice = document.getElementsByClassName("priceBook");
	let subtotal =  document.getElementsByClassName("subtotalPrice");
	let newPrice = [];
	let subNewPrice = [];
	for ( let i = 0; i < n; i++){
		switch(coin) {
			case "ARS": newPrice[i] = priceBook[i]; break;
			case "BRL": newPrice[i] = priceBook[i] + " / 14"; break;
			case "EUR": newPrice[i] = priceBook[i] + " / 66"; break;
			case "MXN": newPrice[i] = priceBook[i] + " / 3"; break;
			case "USD": newPrice[i] = priceBook[i] + " / 60"; break;
			case "UYU": newPrice[i] = priceBook[i] + " / 1.5"; break;
		}
		realPrice[i].innerHTML = eval(newPrice[i]).toFixed(2);
		if (catalogue) {
			small[i].innerHTML = " " + coin;
				if (coin == "EUR") {
					priceSign[i].innerHTML = "€&nbsp";
				}
				else {
					priceSign[i].innerHTML = "$&nbsp";
				}
		} 
		else if (cartTitle) {
			for ( let j = 0; j <= m; j++) {
				small[j].innerHTML = " " + coin;
				if (coin == "EUR") {
					priceSign[j].innerHTML = "€&nbsp";
				}
				else {
					priceSign[j].innerHTML = "$&nbsp";
				}
			}
		}
	}
	localStorage.setItem("country",coin);
	let key = selectCoin.selectedIndex;
	localStorage.setItem("key",key);
}

//funcion para que quede la moneda seleccionada al actualizar o volver
function localSelect() {
	if (localStorage.getItem("country")) {
		let country = localStorage.getItem("country");
		let key = localStorage.getItem("key");
		selectCoin.options[key].value = country;
		selectCoin.options[key].selected = "selected";
	}
}

// multiplicar y sumar precios al cargar carrito
function loadFinalPrice() {
	let subtotal =  document.getElementsByClassName("subtotalPrice");
	let unitPrice = document.getElementsByClassName("unitPrice");
	let totalPrice;
	let quantity = [];
	let z = 0;
	for ( let j = 0; j < m; j++) { 
		quantity[j] = document.getElementsByClassName("quan")[j].value;
		subtotal[j].innerHTML = (quantity[j] * unitPrice[j].innerHTML).toFixed(2);
		z += Number(subtotal[j].innerHTML);
	}
	totalPrice = z.toFixed(2);
	document.getElementById("totalPrice").innerHTML = totalPrice;
}

var quantityAnt = [];
for ( let i = 0; i < m; i++) { //ver cantidades por defecto
	quantityAnt[i] = document.getElementsByClassName("quan")[i].value;
}
// funcion para ver que valor es diferente
function checkDifferent(a,b) {
	let h;
	for ( let i = 0; i < a.length; i++) {
		 if (a[i] != b[i]){
		 	h = a[i];
		 	break;
		 }
	}
	return h;
}
//indice del valor diferente
function getKey(a,b) {
	let h;
	for ( let i = 0; i < a.length; i++) {
		 if (a[i] != b[i]){
		 	h = i;
		 	break;
		 }
	}
	return h;
}

//multiplicar y sumar precios al cambiar cantidades
function finalPrice() {
	let key, quan; 
	let z = 0;
	let quantityPost = [];
	for ( let i = 0; i < m; i++) { 
		quantityPost[i] = document.getElementsByClassName("quan")[i].value;
	}
	quan = checkDifferent(quantityPost,quantityAnt);
	key = getKey(quantityPost,quantityAnt);
	for ( let i = 0; i < m; i++) { 
		quantityAnt[i] = quantityPost[i];
	}
	let unitPrice = document.getElementsByClassName("unitPrice")[key].innerHTML;
	let subtotal =  document.getElementsByClassName("subtotalPrice");
	subtotal[key].innerHTML = (quan * unitPrice).toFixed(2);
	for ( let j = 0; j < m; j++) {
		z += Number(subtotal[j].innerHTML);
	}
	totalPrice = z.toFixed(2);
	document.getElementById("totalPrice").innerHTML = totalPrice;
	localStorage.setItem("quantities",JSON.stringify(quantityPost));
}

//cargar cantidades (si las hay) del localstorage
function startQuantities() {
	let newQuants = [];
	let oldQuants = [];
	for ( let j = 0; j < m; j++) {
		document.getElementsByClassName("quan")[j].value = 1;
		newQuants[j] = document.getElementsByClassName("quan")[j].value;
	}
	if (localStorage.getItem("quantities")) {
		let quants = JSON.parse(localStorage.getItem("quantities"));
		let w = quants.length;
		for ( let j = 0; j < m; j++) {
			oldQuants[j] = document.getElementsByClassName("quan")[j].value;
		}
		oldQuants.splice(0,w);
		let newQuants = quants.concat(oldQuants);
		for ( let j = 0; j < m; j++) {
			document.getElementsByClassName("quan")[j].value = newQuants[j];
		}
	localStorage.setItem("quantities",JSON.stringify(newQuants));
	}
} 

//para que al quitar un libro tambien quite su cantidad
function takeOffBook() {
	let queryString = new URLSearchParams(window.location.search); 
	if (queryString.has('takeOff')){
		let takeValue = queryString.get('takeOff');
		if (localStorage.getItem("quantities")) {
			let quants = JSON.parse(localStorage.getItem("quantities"));
			quants.splice(takeValue,1);
			if (m >= 1) {
				for ( let j = 0; j < m; j++) {
					document.getElementsByClassName("quan")[j].value = quants[j];
				}
			localStorage.setItem("quantities",JSON.stringify(quants));
			}		
			window.location = "./cart.php";
		}
	}
}
	
function initial() {
	if (catalogue || cartTitle) {
		localSelect();
		changeCoin();
	}
	if (cartTitle) {
		startQuantities();
		loadFinalPrice();//poner en funcion
		if (window.location.search != false){
			takeOffBook();
		}	
	}
}

if (selectCoin) {
	if (catalogue || cartTitle) {
		selectCoin.addEventListener("change",changeCoin);
	}
	if (cartTitle) {
		selectCoin.addEventListener("change",loadFinalPrice);
		for (  let i = 0; i < m; i++) { 
			quantitySelect[i].addEventListener("input",finalPrice);
		}
	}
	// para que las monedas se carguen de acuerdo al select al cargar incluyo changeCoin
	window.beforeprint = initial();
}

var eye = document.getElementById("eye");
function viewPass() {
	let inputPass = document.getElementById("pass1");
	if (inputPass.type === "password") {
		inputPass.type = "text";
		eye.className = "fas fa-eye";
	} 
	else {
		inputPass.type = "password";
		eye.className = "fas fa-eye-slash";
	}
}
if(eye){
	eye.addEventListener("click",viewPass);
}
