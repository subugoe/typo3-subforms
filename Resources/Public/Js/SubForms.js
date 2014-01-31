
$(document).ready(function() {
  if (Modernizr.inputtypes.date === false) {
    $("#buecherwunsch-deadline").datepicker($.datepicker.regional.de);
  }
  $(".subforms input[required]").siblings("label").append("*");
  return $(".subforms #buecherwunsch-isbn").blur(function() {
    if ($("#buecherwunsch-isbn").val() !== "") {
      return $.getJSON("/typo3conf/ext/subforms/Resources/Public/Ajax/MetaData.php", {
        isbn: $(this).val()
      }, function(data) {
        var fieldlist, index, _results;
        if (data !== null) {
          fieldlist = {
            title: "title",
            author: "author",
            publisher: "editor",
            year: "publishingYear",
            ed: "issue"
          };
          _results = [];
          for (index in fieldlist) {
            if ($(".subforms #buecherwunsch-" + fieldlist[index]).val() === "") {
              _results.push($(".subforms #buecherwunsch-" + fieldlist[index]).attr("value", data[index]));
            } else {
              _results.push(void 0);
            }
          }
          return _results;
        }
      });
    }
  });
});
