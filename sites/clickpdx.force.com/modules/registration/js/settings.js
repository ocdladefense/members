var CLICKPDX = {
	redirectOnSubmit: false,
	redirectUrl: 'www.mydomain.org/welcome.html',
	subscriptionCallout: {
		'apexType':'ClickpdxCore.CustomHttpSendable',
		'endpoint':'/signup/remotesignup.jsp',
		'domain':'www2.smartbrief.com'
	},
	onSuccessfulRegister: function(e){ /* fire some event */},
	onSuccessfulSubscribe: function(e){ /* fire some event */},
	parentAccountId: '0015C00000JOPQh'
	// maybe? onFailure? trigger email or something
};