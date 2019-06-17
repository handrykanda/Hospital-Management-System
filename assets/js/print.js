$('#print').on('click', function () {
	
	$('#patient').printThis({
		debug: false, // show the iframe for debugging
		importCSS: true, // import parent page css
		importStyle: false, //import style tags
		printContainer: true, // print outer container/$.selector
		loadCSS: "", //additional css file - multiple css in array []
		pageTitle: "Samuel Leon", //add title to print page
		removeInline: false, //remove all inline styles
		printDelay: 333, //variable print delay
		header:"<h5 class='text-center'>Samuel Leon </h5>", //prefix to html
		footer: null, //postfix to html
		formValues: true, //preserve input/form values
		canvas:false, //copy canvas content (experimental)
		base: false, //preserve the base tag or accept a string for the url
		doctypeString: '<!DOCTYPE html>', //html doctype
		removeScripts: false, //remove script tags bfo appending
		copyTagClasses: false // copy classes from html and body tags
	});
});