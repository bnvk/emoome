/**
 * jQuery.timers - Timer abstractions for jQuery
 * Written by Blair Mitchelmore (blair DOT mitchelmore AT gmail DOT com)
 * Licensed under the WTFPL (http://sam.zoy.org/wtfpl/).
 * Date: 2009/10/16
 *
 * @author Blair Mitchelmore
 * @version 1.2
 *
 **/
jQuery.fn.extend({
	everyTime: function(interval, label, fn, times) {
		return this.each(function() {
			jQuery.timer.add(this, interval, label, fn, times);
		});
	},
	oneTime: function(interval, label, fn) {
		return this.each(function() {
			jQuery.timer.add(this, interval, label, fn, 1);
		});
	},
	stopTime: function(label, fn) {
		return this.each(function() {
			jQuery.timer.remove(this, label, fn);
		});
	}
});


jQuery.extend({
	timer: {
		global: [],
		guid: 1,
		dataKey: "jQuery.timer",
		regex: /^([0-9]+(?:\.[0-9]*)?)\s*(.*s)?$/,
		powers: {
			// Yeah this is major overkillÉ
			'ms': 1,
			'cs': 10,
			'ds': 100,
			's': 1000,
			'das': 10000,
			'hs': 100000,
			'ks': 1000000
		},
		timeParse: function(value) {
			if (value == undefined || value == null)
				return null;
			var result = this.regex.exec(jQuery.trim(value.toString()));
			if (result[2]) {
				var num = parseFloat(result[1]);
				var mult = this.powers[result[2]] || 1;
				return num * mult;
			} else {
				return value;
			}
		},
		add: function(element, interval, label, fn, times) {
			var counter = 0;
			
			if (jQuery.isFunction(label)) {
				if (!times) 
					times = fn;
				fn = label;
				label = interval;
			}
			
			interval = jQuery.timer.timeParse(interval);

			if (typeof interval != 'number' || isNaN(interval) || interval < 0)
				return;

			if (typeof times != 'number' || isNaN(times) || times < 0) 
				times = 0;
			
			times = times || 0;
			
			var timers = jQuery.data(element, this.dataKey) || jQuery.data(element, this.dataKey, {});
			
			if (!timers[label])
				timers[label] = {};
			
			fn.timerID = fn.timerID || this.guid++;
			
			var handler = function() {
				if ((++counter > times && times !== 0) || fn.call(element, counter) === false)
					jQuery.timer.remove(element, label, fn);
			};
			
			handler.timerID = fn.timerID;
			
			if (!timers[label][fn.timerID])
				timers[label][fn.timerID] = window.setInterval(handler,interval);
			
			this.global.push( element );
			
		},
		remove: function(element, label, fn) {
			var timers = jQuery.data(element, this.dataKey), ret;
			
			if ( timers ) {
				
				if (!label) {
					for ( label in timers )
						this.remove(element, label, fn);
				} else if ( timers[label] ) {
					if ( fn ) {
						if ( fn.timerID ) {
							window.clearInterval(timers[label][fn.timerID]);
							delete timers[label][fn.timerID];
						}
					} else {
						for ( var fn in timers[label] ) {
							window.clearInterval(timers[label][fn]);
							delete timers[label][fn];
						}
					}
					
					for ( ret in timers[label] ) break;
					if ( !ret ) {
						ret = null;
						delete timers[label];
					}
				}
				
				for ( ret in timers ) break;
				if ( !ret ) 
					jQuery.removeData(element, this.dataKey);
			}
		}
	}
});

jQuery(window).bind("unload", function() {
	jQuery.each(jQuery.timer.global, function(index, item) {
		jQuery.timer.remove(item);
	});
});



// JQuery URL Parser
// Written by Mark Perkins, mark@allmarkedup.com
// License: http://unlicense.org/ (i.e. do what you want with it!)
jQuery.url = function()
{
	var segments = {};
	var parsed = {};

	/* Options object. Only the URI and strictMode values can be changed via the setters below. */
  	var options = {
	
		url 		: window.location, // default URI is the page in which the script is running
		strictMode	: false, // 'loose' parsing by default
		key			: ["source","protocol","authority","userInfo","user","password","host","port","relative","path","directory","file","query","anchor"], // keys available to query 
		q : {
			name: "queryKey",
			parser: /(?:^|&)([^&=]*)=?([^&]*)/g
		},
		parser		: {
			strict: /^(?:([^:\/?#]+):)?(?:\/\/((?:(([^:@]*):?([^:@]*))?@)?([^:\/?#]*)(?::(\d*))?))?((((?:[^?#\/]*\/)*)([^?#]*))(?:\?([^#]*))?(?:#(.*))?)/,  //less intuitive, more accurate to the specs
			loose:  /^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@]*):?([^:@]*))?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/ // more intuitive, fails on relative paths and deviates from specs
		}
	};
	
    /* Deals with the parsing of the URI according to the regex above. Written by Steven Levithan - see credits at top. */		
	var parseUri = function()
	{
		str = decodeURI( options.url );
		
		var m = options.parser[ options.strictMode ? "strict" : "loose" ].exec( str );
		var uri = {};
		var i = 14;

		while ( i-- ) {
			uri[ options.key[i] ] = m[i] || "";
		}

		uri[ options.q.name ] = {};
		uri[ options.key[12] ].replace( options.q.parser, function ( $0, $1, $2 ) {
			if ($1) {
				uri[options.q.name][$1] = $2;
			}
		});

		return uri;
	};

    /* Returns the value of the passed in key from the parsed URI. 
       @param string key The key whose value is required 
    */		
	var key = function( key )
	{
		if ( jQuery.isEmptyObject(parsed) )
		{
			setUp(); // if the URI has not been parsed yet then do this first...	
		} 
		if ( key == "base" )
		{
			if ( parsed.port !== null && parsed.port !== "" )
			{
				return parsed.protocol+"://"+parsed.host+":"+parsed.port+"/";	
			}
			else
			{
				return parsed.protocol+"://"+parsed.host+"/";
			}
		}
	
		return ( parsed[key] === "" ) ? null : parsed[key];
	};
	
	/* Returns the value of the required query string parameter.
	   @param string item The parameter whose value is required
    */		
	var param = function( item )
	{
		if ( jQuery.isEmptyObject(parsed) )
		{
			setUp(); // if the URI has not been parsed yet then do this first...	
		}
		return ( parsed.queryKey[item] === null ) ? null : parsed.queryKey[item];
	};

    /* 'Constructor' (not really!) function.
       Called whenever the URI changes to kick off re-parsing of the URI and splitting it up into segments. 
    */	
	var setUp = function()
	{
		parsed = parseUri();
		getSegments();	
	};
	
    /* Splits up the body of the URI into segments (i.e. sections delimited by '/') */
	var getSegments = function()
	{
		var p = parsed.path;
		segments = []; // clear out segments array
		segments = parsed.path.length == 1 ? {} : ( p.charAt( p.length - 1 ) == "/" ? p.substring( 1, p.length - 1 ) : path = p.substring( 1 ) ).split("/");
	};
	
	return {
		
	    /* Sets the parsing mode - either strict or loose. Set to loose by default.
	       @param string mode The mode to set the parser to. Anything apart from a value of 'strict' will set it to loose!
	    */
		setMode : function( mode )
		{
			options.strictMode = mode == "strict" ? true : false;
			return this;
		},
		
		/* Sets URI to parse if you don't want to to parse the current page's URI. Calling the function with no value for newUri resets it to the current page's URI.
	       @param string newUri The URI to parse.
	     */		
		setUrl : function( newUri )
		{
			options.url = newUri === undefined ? window.location : newUri;
			setUp();
			return this;
		},		
		
		/* Returns the value of the specified URI segment. Segments are numbered from 1 to the number of segments. For example the URI http://test.com/about/company/ segment(1) would return 'about'.  If no integer is passed into the function it returns the number of segments in the URI.
	       @param int pos The position of the segment to return. Can be empty.
	    */	
		segment : function( pos )
		{
			if ( jQuery.isEmptyObject(parsed) )
			{
				setUp(); // if the URI has not been parsed yet then do this first...	
			} 
			if ( pos === undefined )
			{
				return segments.length;
			}
			return ( segments[pos] === "" || segments[pos] === undefined ) ? null : segments[pos];
		},
		
		attr 	: key, // provides public access to private 'key' function - see above
		param 	: param // provides public access to private 'param' function - see above		
	};
}();




/*	Validator - jQuery Plugin
	Awesome form validation and messaging plugin
	Settings are:
	 - element	: Array of elements, contains: selector, rule, field, action (label, border, element)
	 - styles	: Styles for labels and input fields
	 - message	: Is appended to the start of invalid elements 'Please enter a _________'
*/
(function($)
{
	$.validator = function(options) 
	{
		var defaults = 
		{
			elements	: [],
			styles		: { valid : 'form_valid', error : 'form_error' },
			message		: '',
			success		: function(){},
			failed		: function(error_messages){}
		};

		var settings		= $.extend(defaults, options);
		var valid_count		= 0;
		var invalid_count	= 0;
		var element_count	= settings.elements.length;
		var error_messages	= '';

		// Validate Rules
		function validateRequire(value)
		{		
			if (value != '') return true;
			return false;
		}

		function validateInteger(value)
		{		
			if (value > 0) return true;
			return false;
		}

		function validateConfirm(source_value, confirm_selector)
		{
			var confirm_source	= confirm_selector.replace('_confirm', ''); 
			var confirm_value	= $(confirm_source).val();
			var confirm_state	= false;

			if (source_value == confirm_value && source_value != '') confirm_state = true;

			return confirm_state;
		}
		
		function validateEmailAddress(email)
		{
			var email_pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
			return email_pattern.test(email);
		}
		
		function validateUsPhoneNumber(phone_number)
		{
			var phone_number_pattern = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;
			return phone_number_pattern.test(phone_number);  
		}
		
		function validateCreditCard(creditcard)
		{
		    if (getCreditCardTypeByNumber(creditcard) == '?') return false;
		    return true;
		}
		
		// Credit Card
		function getCreditCardTypeByNumber(ccnumber) {
		    var cc = (ccnumber + '').replace(/\s/g, ''); //remove space
		 
		    if ((/^(34|37)/).test(cc) && cc.length == 15) {
		        return 'AMEX'; //AMEX begins with 34 or 37, and length is 15.
		    } else if ((/^(51|52|53|54|55)/).test(cc) && cc.length == 16) {
		        return 'MasterCard'; //MasterCard beigins with 51-55, and length is 16.
		    } else if ((/^(4)/).test(cc) && (cc.length == 13 || cc.length == 16)) {
		        return 'Visa'; //VISA begins with 4, and length is 13 or 16.
		    } else if ((/^(300|301|302|303|304|305|36|38)/).test(cc) && cc.length == 14) {
		        return 'DinersClub'; //Diners Club begins with 300-305 or 36 or 38, and length is 14.
		    } else if ((/^(2014|2149)/).test(cc) && cc.length == 15) {
		        return 'enRoute'; //enRoute begins with 2014 or 2149, and length is 15.
		    } else if ((/^(6011)/).test(cc) && cc.length == 16) {
		        return 'Discover'; //Discover begins with 6011, and length is 16.
		    } else if ((/^(3)/).test(cc) && cc.length == 16) {
		        return 'JCB';  //JCB begins with 3, and length is 16.
		    } else if ((/^(2131|1800)/).test(cc) && cc.length == 15) {
		        return 'JCB';  //JCB begins with 2131 or 1800, and length is 15.
		    }
		    return '?';
		}
				
		

		// Message Types
		function messageLabel(valid, element)
		{	
			var selector_error = element.selector + '_error';
			
			// Element has label message
			if (valid && $(selector_error).length != 0)
			{
				$(element.selector + '_error').html('').removeClass(settings.styles.error).addClass(settings.styles.valid);			
				$(element.selector + '_error').oneTime(300, function() { $(this).fadeOut() });
			}
			else
			{	
				// Label exists		
				if ($(selector_error).length != 0)
				{
					$(selector_error).html(settings.message + ' ' + element.field).removeClass(settings.styles.valid).addClass(settings.styles.error);
					$(element.selector + '_error').oneTime(150, function() { $(this).fadeIn() });
				}
			}
		}
		
		function messageBorder(valid, element)
		{
			if (!valid && $(element.selector).length != 0)
			{
				$(element.selector).css('border', '1px solid red');
			}
		}

		function messageElement(valid, element)
		{
			if (!valid && $(element.selector).length != 0)
			{
				$(element.selector).val(element.field).addClass(settings.styles.error);
				$(element.selector).oneTime(1000, function()
				{ 
					$(element.selector).val('').removeClass(settings.styles.error)
				});				
			}
		}
		
		function messageNone()
		{
			return false;
		}


		// Loops through 'elements' and runs values
		$.each(settings.elements, function(index, element)
		{		
			var validate = $(element.selector).val();
			var is_valid = false;
			
			// Validate By Rule
			if (element.rule == 'require')
			{
				is_valid = validateRequire(validate);				
			}
			else if (element.rule == 'require_integer')
			{
				is_valid = validateInteger(validate);				
			}
			else if (element.rule == 'email')
			{
				is_valid = validateEmailAddress(validate);
			}
			else if (element.rule == 'us_phone')
			{
				is_valid = validateUsPhoneNumber(validate);
			}
			else if (element.rule == 'confirm')
			{
				is_valid = validateConfirm(validate, element.selector);
			}
			else if (element.rule == 'credit_card')
			{
				is_valid = validateCreditCard(validate);
			}
			else if (jQuery.isFunction(element.rule))
			{			
				is_valid = element.rule(element.selector);
			}
			else
			{
				is_valid = false;
			}
			
			// Element Action
			if (element.action == 'label')
			{
				messageLabel(is_valid, element);
			}
			else if (element.action == 'border')
			{
				messageBorder(is_valid, element);
			}
			else if (element.action == 'element')
			{
				messageElement(is_valid, element);
			}
			else
			{
				messageNone();
			}
			
			// Valid Count
			if (!is_valid)
			{				
				error_messages += ' ' + element.field + ',';
			}
			else
			{			
				valid_count++;
			}

		});
		
		// Fire Success / Error Callback
		if (valid_count == element_count)
		{
			settings.success();
		}
		else
		{
			var error_output = error_messages.substring(0, error_messages.length - 1);
			settings.failed(error_output);
		}
	};
})(jQuery);
