function hideError(input) {
	var error_element = $("span", input.parent());
	error_element.removeClass("error_show").addClass("error");
}

function showError(input) {
	var error_element = $("span", input.parent());
	error_element.removeClass("error").addClass("error_show");
}

function validateInput(input) {
	if (input.val()) {
		hideError(input);
		return true;
	} else {
		showError(input);
		return false;
	}
}

function validateEmail(input) {
	var regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
	var is_email = regex.test(input.val());
	if (is_email) {
		hideError(input);
		return true;
	} else {
		showError(input);
		return false;
	}
}
