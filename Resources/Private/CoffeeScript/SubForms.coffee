$(document).ready ->
	if Modernizr.inputtypes.date is false
		$("#buecherwunsch-deadline").datepicker $.datepicker.regional.de

	# provide required fields with an asterisk
	$(".subforms input[required]").siblings("label").append "*"

	# make an asynchronous call to an isbn-metadata retriever and display the results
	$(".subforms #buecherwunsch-isbn").blur ->
		unless $("#buecherwunsch-isbn").val() is ""
			$.getJSON "/typo3conf/ext/subforms/Resources/Public/Ajax/MetaData.php",
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
						$(".subforms #buecherwunsch-" + fieldlist[index]).attr "value", data[index]  if $(".subforms #buecherwunsch-" + fieldlist[index]).val() is ""