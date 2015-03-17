$(document).ready ->
	if Modernizr.inputtypes.date is false
		$("#buecherwunsch-deadline").datepicker $.datepicker.regional.de

	# make an asynchronous call to an isbn-metadata retriever and display the results
	$(".subforms #isbn").blur ->
		unless $("#isbn").val() is ""
			$.getJSON "/?eID=buecherwunsch",
				isbn: $(this).val()
			, (data) ->
				if data isnt null
					fieldlist =
						title: "title"
						author: "author"
						publisher: "editor"
						year: "publishingYear"
						ed: "issue"

					for index of fieldlist
						$(".subforms #" + fieldlist[index]).attr "value", data[index]  if $(".subforms #" + fieldlist[index]).val() is ""
