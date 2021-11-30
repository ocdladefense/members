jQuery(function(){

	jQuery('.control-label').each(function(){
	
		console.log($(this).text());
		$labelText = $(this).text();
		if($labelText.indexOf('OCDLA')===0){
			$(this).text($labelText.substr(6));
		}
		
		if($labelText.indexOf('Salutation')===0){
			$(this).text('Title');
		}
		
		$(this).removeClass('required-true');
		
	
	});
	
	jQuery('.control-label').each(function(){
		$labelText = $(this).text();	
		$search = 'Areas';
		$pos = $labelText.indexOf($search);
			
		if($pos !== -1){
			$(this).text('Area '+$labelText.substr($pos+$search.length));
		}
	});
	
	var theIndex;
	
	jQuery('.control-label').each(function(index,val){
		$labelText = $(this).text();	
		$search = 'Address Line 2';
		$pos = $labelText.indexOf($search);
			
		if($pos !== -1){
			theIndex = index;
			$(this).text('Address Line 1');
		}
	});
	
	jQuery('.control-label').each(function(index,val){
		if(index==theIndex+1){
			$(this).text('Address Line 2');
		}
	});

});