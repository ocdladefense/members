
// alert('I am the List View module.');
	var opts = [
		{ name: "Morrow - missing emails",value: '1',disabled:false,whereClause:"EventId__c='a230a000002KSt6' AND Contact__r.Email = null"},
		{ name: "General Fund Donations",value: '1',disabled:false,whereClause:"Product2.Name='General Support Fund'"},
		{ name: "Building Fund Donations",value: '2',disabled:false,whereClause:"Product2.Name='Building Fund'"},
		{ name: "Legislative Fund Donations",value: '3',disabled:false,whereClause:"Product2.Name='Legislative Fund'"},
		{ name: "OCDLA Pac Fund Donations",value: '4',disabled:false,whereClause:"Product2.Name='OCDLA Pac'"},
	];
	
	function getOpt(value){
		for(var i = 0; i<opts.length; i++){
			if(opts[i].value == value) return opts[i];
		}
	}
	
	
$(function(){

	
	var optionsHtml = opts.map((item)=>{return '<option value="'+item.value+'">'+item.name+'</option>';}).join('\n');
	
	$('#list-view-picker').html('<label style="display:block;font-weight:bold;">Product Lists:</label><select><option disabled="disabled" selected="selected">Select  Product</option>'+optionsHtml+'</select>');
	
	$('#list-view-picker select').on('change',function(){
		var selected = $(this).val();
		var opt = getOpt(selected);
		var url = "ClickpdxOrderItems?whereClause="+opt.whereClause;
		window.location.href=url;
		console.log(opt);
	});
	
});

$(function(){
	document.getElementsByTagName('body')[0].addEventListener('change',function(e){
		var theLine = {};

		console.log(e.target.parentElement);
		var parent = e.target.parentElement;
		var dataset = parent.dataset;
		if(null == dataset) return false;
		var Id = parent.dataset.lineId || null;
		if(null == Id) return false;
		theLine.Id = Id;
		theLine.Note_1__c = $('[data-line-id="'+Id+'"] input[name="note_1-c"]').val();
		theLine.Note_2__c = $('[data-line-id="'+Id+'"] input[name="note_2-c"]').val();
		theLine.Note_3__c = $('[data-line-id="'+Id+'"] input[name="note_3-c"]').val();
		theLine.Description = $('[data-line-id="'+Id+'"] input[name="description"]').val();
		theLine.FirstName__c = $('[data-line-id="'+Id+'"] input[name="firstname-c"]').val();
		theLine.LastName__c = $('[data-line-id="'+Id+'"] input[name="lastname-c"]').val();
		
		console.log(theLine);
		saveData(theLine)
		.then(function(lines){
			console.log(lines);
		})
		.catch(function(error){
			alert('There is an error.');
		});
	},false);
});

function saveData(line){
	return new Promise(function(resolve,reject){
		ClickpdxOrderItems.updateLine(line,function(result, event){
			if (event.status) {
				resolve(result);
			} else {
				reject(result,event);
			}
		}, 
		{escape: true});
	});
}