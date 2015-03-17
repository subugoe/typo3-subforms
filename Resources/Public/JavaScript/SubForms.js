$(document).ready(function() {
  if (Modernizr.inputtypes.date === false) {
    $("#buecherwunsch-deadline").datepicker($.datepicker.regional.de);
  }
  return $(".subforms #isbn").blur(function() {
    if ($("#isbn").val() !== "") {
      return $.getJSON("/?eID=buecherwunsch", {
        isbn: $(this).val()
      }, function(data) {
        var fieldlist, index, results;
        if (data !== null) {
          fieldlist = {
            title: "title",
            author: "author",
            publisher: "editor",
            year: "publishingYear",
            ed: "issue"
          };
          results = [];
          for (index in fieldlist) {
            if ($(".subforms #" + fieldlist[index]).val() === "") {
              results.push($(".subforms #" + fieldlist[index]).attr("value", data[index]));
            } else {
              results.push(void 0);
            }
          }
          return results;
        }
      });
    }
  });
});
