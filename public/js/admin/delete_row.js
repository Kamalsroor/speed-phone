/*******************************************/
/*            delete category              */
/*******************************************/
$("body").on("click", ".delete", function() {
    var $this = $(this),
        DelUrl = $this.attr("del-url"),
        DelName = $this.attr("del-name"),
        title = $this.attr("data-title-message"),
        message = $this.attr("data-message"),
        okay = confirm("Do you want to delete " + DelName + "?");
    if (okay) {
        $.ajax({
            url: DelUrl,
            dataType: "json",
            cache: false,
            /*contentType: false,
      processData: false,*/
            data: { _method: "Delete" },
            type: "post",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            success: function(data) {
                var status = data.status;
                if (status === true) {
                    $this.parents("tr").fadeOut(500, function() {
                        $(this).remove();
                        swal({
                            title: title,
                            text: message,
                            icon: "success",
                            button: false,
                            timer: 2000
                        });
                    });
                }
            }
        });
    }
});
