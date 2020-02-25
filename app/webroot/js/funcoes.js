function number_format(number, decimals, decPoint, thousandsSep){
	decimals = decimals || 0;
	number = parseFloat(number);
 
	if(!decPoint || !thousandsSep){
		decPoint = '.';
		thousandsSep = ',';
	}
 
	var roundedNumber = Math.round( Math.abs( number ) * ('1e' + decimals) ) + '';
	var numbersString = decimals ? roundedNumber.slice(0, decimals * -1) : roundedNumber;
	var decimalsString = decimals ? roundedNumber.slice(decimals * -1) : '';
	var formattedNumber = "";
 
	while(numbersString.length > 3){
		formattedNumber += thousandsSep + numbersString.slice(-3)
		numbersString = numbersString.slice(0,-3);
	}
 	
	number = (number < 0 ? '-' : '') + numbersString + formattedNumber + (decimalsString ? (decPoint + decimalsString) : '');

	if (number.charAt(0) == ',')
		return "0" + number;

	return number;
}
 