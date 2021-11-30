define(["all/modules/cart/js/salesforce/visualforce-actions"],function(vfActions){

	/**
	 * TEMPLATE FOR A FORM OBJECT
	 */
	var steak = {
		category: "Steak",
		name: "Grilled Flat Iron Steak",
		description: "Roasted Potatoes, Onions and Wild Mushroom Jus"
	};

	var salmon = {
		category: "Salmon",
		name: "Honey-Soy Glazed Salmon",
		description: "Green Rice Pilaf, Sesame Vegetables and Lemon Aioli"
	};

	var vegan = {
		category: "Vegan",
		name: "Stuffed Acorn Squash",
		description: "Tofu and brown rice stuffing, sautéed mushrooms and marinara"
	};
	

	var base = {
		title: "Ken Morrow Award Dinner - Guests & Meal Preference",
		
		message: "Please select your guests and meal preferences",

		meals: [steak,salmon,vegan],
		
		renderMe: function(rows) {
			rows = rows || 1;

			var data = this.getData();
			
			var container = h("div",{style:"overflow-y:scroll;"},[h("h2",{},this.title),h("p",{className:"description"},this.message)]);
			
			for(var i = 0; i<base.meals.length; i++){
				container.children.push(base.menuItem(base.meals[i]));
			}
			
			var form = h("form",{});
			
			form.children = [base.regNode(1,data.firstName,data.lastName,data.meal)];
			for(var idx = 2; idx<=rows; idx++){
				form.children.push(base.regNode(idx));
			}
	
			container.children.push(form);
			
			return container;
		},
		
		regNode: function(index,firstName,lastName,meal){
			index = index || 0;
			firstName = firstName || "";
			lastName = lastName || "";
			meal = meal || "";
			
			var rOpts = rOpts || [
				{name:"Steak",value:"steak"},
				{name:"Salmon",value:"salmon"},
				{name:"Vegan",value:"vegan"}
			];
	
			var wrapper = h("div",{className:"form-item form-registrant"});
			
			var children = [
				h("label",{},"First Name"),
				h("input",{type:"text",name:"firstName",value:firstName,placeholder:"Reg first name"}),
				h("label",{},"Last Name"),
				h("input",{type:"text",name:"lastName",value:lastName,placeholder:"Reg last name"}),
				h("label",{},"Meal Choice")
			];
	
			rOpts.forEach(function(opt){
				children.push(h("text",{},opt.name));
				var opts = {type:"radio",name:"meal",value:opt.value};
				if(meal == opt.value) {
					opts.selected = "selected";
				}
				children.push(h("input",opts,opt.name));
			});
			
			wrapper.children = children;
	
			return wrapper;
		},
		
		menuItem: function(item){
			var meal = h("div",{className:"dinner-menu-item"});
			meal.children = [
				h("span",{className:"dinner-type"},item.category),
				h("span",{className:"dinner-title"},item.name),
				h("span",{className:"dinner-description"},item.description)
			];
			
			return meal;
		},

		getFormData: function(){
			var d = [];
			$regs = $("div[class*='form-registrant']");
			
			for(var i = 0; i<$regs.length; i++){
				$meal = $regs.eq(i);
				$theMeal = $meal.find("input[name*='meal']:checked");
				$theFirst = $meal.find("input[name*='firstName']");
				$theLast = $meal.find("input[name*='lastName']");
				var one = {}; one["meal"] = $theMeal.val();
				one.firstName = $theFirst.val();
				one.lastName = $theLast.val();
				d.push(one);
			}
			
			return d;
		},
		
		actions: {
			cancel: function(entryId,fdata){
				if(window.confirm("Are you sure you want to Cancel?  Your changes will not be saved.")) {
					modal.hide();
				}
				
				return false;
			},
			add: function(entryId,fdata){
				
				jsonData = JSON.stringify(fdata);
				
				vfActions.addItem(entryId,1,jsonData).then(function(){
					modal.hide();
				});
				
				return false;
			}
		}
		

	};
	

	
	return base;
});