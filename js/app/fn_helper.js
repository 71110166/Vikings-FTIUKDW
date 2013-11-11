/*
 *	@file: fn_helper.js
 *  @desc: Various user defined helper js function
 **/

 /* Note: this script requires jQuery loaded */

// global fn object
 var fn = {

 	/* functions */

 	// escape html tags from string
 	htmlEscape: function(str = '') {
 		return $('<div/>').text(str).html();
 	}

 };