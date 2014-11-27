jQuery(document).ready(function() {

	//click on continent
	jQuery('.continentSelection  li a').click(function() {
		jQuery(this).closest('.continentSelection').find('li').removeClass('selected');
		jQuery(this).closest('li').addClass('selected');
		jQuery('#selectState').fadeOut('fast');
		jQuery('#localWebsite, #partnerList .country').slideUp();
		var continentID = jQuery(this).attr('class');
		var countries = partners.getCountries(continentID);
		jQuery('#selectCountry').slideDown();
		jQuery('#otherCountries').delay(200).fadeIn()
		jQuery('#country_select').empty().append('<option value="">-- Country --</option>');
		jQuery(countries).each(function(){
			jQuery('#country_select').append('<option value="'+this.replace(' ','')+'">'+this+'</option>');
		});
		partners.setAnchor(continentID);
		return false;
	});
	
	//select country from dropdown
	jQuery('#country_select').change(function() {
		var countryID = jQuery(this).val();
		if (countryID == '') return;
		
		var states = partners.getStates(countryID);
		if (states.length) {
			jQuery('#localWebsite, #partnerList .country').slideUp();
			jQuery('#selectState').fadeIn('fast');
			jQuery('#state_select').empty().append('<option value="">-- State --</option>');
			jQuery(states).each(function(){
				jQuery('#state_select').append('<option value="'+this.replace(' ','')+'">'+this+'</option>');
			});
		} else {
			jQuery('#selectState').fadeOut('fast');
			//go on
			partners.showPartners(countryID);
		}
		partners.setAnchor(countryID);
		return false;
	});
	
	//select state from dropdown
	jQuery('#state_select').change(function() {
		var stateID = jQuery(this).val();
		if (stateID == '') return;	
		
		//go on
		partners.showPartners(stateID,true);
		partners.setAnchor(stateID);
		return false;
	});

	if (jQuery.getAnchor() != null) {
		listId = jQuery.getAnchor().replace('#', '');
		var isContinent = jQuery('.continentSelection li a.' + listId).length ? true : false;
		var isCountry = jQuery('#partnerList #partners_country_' + listId).length ? true : false;
		var isState = jQuery('#partnerList #partners_state_' + listId).length ? true : false;
		var continent, country;
		
		if (isContinent) {
			jQuery('.continentSelection li a.' + listId).click();
		} else if (isState) {
			continent = jQuery('#partnerList #partners_state_' + listId).closest('.country').attr('data-continent');
			country = jQuery('#partnerList #partners_state_' + listId).closest('.country').attr('id').replace('partners_country_','');
			jQuery('.continentSelection li a.' + continent).click();
			jQuery('#country_select').val(country).change();
			jQuery('#state_select').val(listId).change();
		} else if (isCountry) {
			continent = jQuery('#partnerList #partners_country_' + listId).attr('data-continent');
			jQuery('.continentSelection li a.' + continent).click();
			jQuery('#country_select').val(listId).change();
		}
	}
});

var partners = {
	getCountries: function(continentID) {
		var countries = [];
		var c = jQuery('#countryList #continent_' + continentID + ' li a');
		c.each(function(i) {
			countries.push(jQuery(this).text());
		});
		return countries;
	},
	getStates: function(listId) {
		var states = [];
		var s = jQuery('#stateList #states_country_' + listId + ' li a');
		s.each(function(i) {
			states.push(jQuery(this).text());
		});
		return states;
	},
	showPartners: function(listId,isState) {
		//show list of localized Nicelabel sites
		jQuery('#localWebsite').slideDown();
		//hide all countries/states that were opened before
		jQuery('#partnerList .country, #partnerList .state').hide();
		//show the country/state that user clicked on
		if (!isState) {
			//show all states as there are none
			jQuery('#partnerList #partners_country_' + listId + ' .state').show();
			jQuery('#partnerList #partners_country_' + listId).slideDown();
			//scroll down to countries
			jQuery('html, body').animate({
				scrollTop: jQuery('#partnerList #partners_country_' + listId + ' h2').offset().top
			});
		} else {
			//show state
			jQuery('#partnerList #partners_state_' + listId).show();
			jQuery('#partnerList #partners_state_' + listId).parent().slideDown();
			//scroll down to countries
			jQuery('html, body').animate({
				scrollTop: jQuery('#partnerList #partners_state_' + listId + ' h2').offset().top
			});
		}
	},
	setAnchor: function(anchor) {
		window.location.hash = anchor;
	}
};

jQuery.extend({
	getUrlVars: function() {
		var vars = [], hash;
		var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
		for(var i = 0; i < hashes.length; i++) {
			hash = hashes[i].split('=');
			vars.push(hash[0]);
			vars[hash[0]] = hash[1];
		}
		return vars;
	},
	getAnchor: function() {
		anchor = window.location.href.split('#')[1];
		
		return typeof anchor != 'undefined' ? '#' + anchor : null;
	},
	getUrlVar: function(name){
		return jQuery.getUrlVars()[name];
	}
});