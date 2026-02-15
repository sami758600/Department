
 jQuery(function(){
	 /*jQuery("#userlevel").validate({
		expression: "if (VAL) return true; else return false;",
		message: "Please enter Level"
	});*/
	 jQuery("#uname").validate({
		expression: "if (VAL) return true; else return false;",
		message: "Please enter User Name"
	});
	
	 jQuery("#pword").validate({
		expression: "if (VAL.length > 5 && VAL) return true; else return false;",
		message: "Please enter a valid Password"
	});
	jQuery("#confirmpassword").validate({
		expression: "if ((VAL == jQuery('#pword').val()) && VAL) return true; else return false;",
		message: "Please enter same password again"
	});	
	jQuery("#levelid").validate({
		expression: "if (VAL) return true; else return false;",
		message: "Please Select User Level"
	});
	jQuery("#admin_mail").validate({
		expression: "if (VAL.match(/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/)) return true; else return false;",
		message: "Please enter a valid Email ID"
	});
	jQuery("#firstname").validate({
		expression: "if (VAL) return true; else return false;",
		message: "Please enter Firstname"
	});
	jQuery("#first_name").validate({
		expression: "if (VAL) return true; else return false;",
		message: "Please enter Firstname"
	});
	jQuery("#lastname").validate({
		expression: "if (VAL) return true; else return false;",
		message: "Please enter the Lastname"
	});
	jQuery("#last_name").validate({
		expression: "if (VAL) return true; else return false;",
		message: "Please enter the Lastname"
	});
	jQuery("#phone_no").validate({
		expression: "if (!isNaN(VAL) && VAL && VAL.length == 10 ) return true; else return false;",
		message: "Please enter Valid Phone Number"
	});
	jQuery("#email").validate({
		expression: "if (VAL.match(/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/)) return true; else return false;",
		message: "Please enter a valid Email ID"
	});
	jQuery("#qualifi").validate({
		expression: "if (VAL) return true; else return false;",
		message: "Please enter Qualification"
	});
	jQuery("#address").validate({
		expression: "if (VAL) return true; else return false;",
		message: "Please enter Address"
	});
	jQuery("#phone").validate({
		expression: "if (!isNaN(VAL) && VAL && VAL.length == 10 ) return true; else return false;",
		message: "Please enter Valid Phone Number"
	});
	jQuery("#profession").validate({
		expression: "if (VAL) return true; else return false;",
		message: "Please enter Profession"
	});
	jQuery("#relation").validate({
		expression: "if (VAL) return true; else return false;",
		message: "Please enter Your Relation"
	});	
	jQuery("#message").validate({
		expression: "if (VAL) return true; else return false;",
		message: "Please enter Your Message"
	});	
});

