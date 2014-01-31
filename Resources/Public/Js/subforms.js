jQuery(document).ready(function () {

	// provide required fields with an asterisk
	jQuery('.subforms input[required]').siblings('label').append('*');

	// make an asynchronous call to an isbn-metadata retriever and display the results
	jQuery('.subforms #buecherwunsch-isbn').blur(function () {
		if (jQuery('#buecherwunsch-isbn').val() != "") {
			jQuery.getJSON('/typo3conf/ext/subforms/Resources/Public/Ajax/MetaData.php', { isbn:jQuery(this).val() }, function (data) {

				if (data != null) {
					var fieldlist = {title:'title', author:'author', publisher:'editor', year:'publishingYear', ed:'issue'};

					for (var index in fieldlist) {
						if (jQuery('.subforms #buecherwunsch-' + fieldlist[index]).val() == "") {
							jQuery('.subforms #buecherwunsch-' + fieldlist[index]).attr('value', data[index]);
						}
					}
				}
			});
		}
	});
	$(function() {
		$("#buecherwunsch-deadline").datepicker($.datepicker.regional[ "de" ]);
	});
})