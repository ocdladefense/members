define([],function(){

	var CURRENCY_PRECISION = 2; // Use two decimal places when evaluating cent formatting.
	
	var ERROR_CODE = "CURRENCY_FORMAT_ERROR: ";
	
	var FRACTION_SEPARATOR = ".";
	
	var CURRENCY_SYMBOL = "$";

	function currencyFormat(str){
		var parts, dollars, fraction;
		
		str = (typeof str === "string") ? str : (str + "");
		
		parts = str.split(FRACTION_SEPARATOR);
		dollars = parts[0];

		fraction = parts.length > 1 ? formatCents(parts[1]) : "00";
		
		dollars = dollars > 999 ? dollars.substr(0,dollars.length-3)+","+dollars.substr(dollars.length - 3) : dollars;
		
		return (CURRENCY_SYMBOL + dollars + FRACTION_SEPARATOR + fraction);
	}
	
	var formatThousands = function(num){
		
	};
	
	var formatCents = function(num){
		num = (typeof num === "string") ? num : (num + "");
		
		num = num.length < CURRENCY_PRECISION ? (num + "0") : num;
		
		if(num.length > CURRENCY_PRECISION) {
			throw new TypeError(ERROR_CODE + num + " is not a valid partial dollar amount.");
		}
		
		return num;
	};
	
	var zero = function(num){
		num = (typeof num === "string") ? num : (num + "");
		
		return ("" == num.trim() || parseInt(0) === parseInt(num));
	};
	
	var number = function(num){
		num = num + "";
		num = num.replace("$","");
		num = num.replace(",","");
		return parseFloat(num);
	};
	
	var total = function(price,qty){
		var total = number(price)*parseFloat(qty);
		total = new Number(total.toFixed(2));
		return total;
	};
	
	
	
	return {
		number: number,
		currency: currencyFormat,
		total: total,
		zero: zero
	};
	
});