define([],function(){
	function fromUnixTimestamp(UNIX_timestamp){
		return (new Date(UNIX_timestamp)).toLocaleString();
	}
	
	function dateFromUnixTimestamp(UNIX_timestamp){
		return (new Date(UNIX_timestamp)).toLocaleString().split(',')[0];
	}
	
	function toSalesforceDate(d){
		var year, month, day;
		
		year = d.getFullYear();
		month = d.getMonth()+1;
		day = d.getDate();
		
		return [year,month,day].join("-");
	}
	
	
	return {
		fromUnixTimestamp: fromUnixTimestamp,
		dateFromUnixTimestamp:dateFromUnixTimestamp,
		toSalesforceDate: toSalesforceDate
	};
	
});