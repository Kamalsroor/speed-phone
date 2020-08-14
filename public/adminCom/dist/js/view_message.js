$(function() {
    function ucWord(str) {
        let strArray = str.split(" "),
            newStr = [];
        strArray.forEach(function(item) {
            newStr.push(
                item.replace(item.charAt(0), item.charAt(0).toUpperCase())
            );
        });
        return newStr.join(" ");
    }
    $(".view-message").on("click", function(e) {
        e.preventDefault();
        // get data [url and modal]
        let $this = $(this), // button view
            url = $this.attr("href"),
            modal = $($this.attr("data-target"));
        $.ajax({
            url: url,
            dataType: "json",
            type: "post",
            cache: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            success: function(data) {
                var status = data.status;
                if (status === true) {
                    if (data.view == 1) {
                        $this
                            .removeClass("btn-primary")
                            .addClass("btn-secondary");
                        $this
                            .find("i")
                            .removeClass("fa-eye")
                            .addClass("fa-eye-slash");
                    }
                    if (data.message != null) {
                        var dataPrint = "",
                            exceptColumn = [
                                "id",
                                "view",
                                // "created_at",
                                "updated_at"
                            ];
                        $.each(data.message, function(key, val) {
                            if (exceptColumn.indexOf(key) == -1) {
                                key = key == "created_at" ? "Sent At" : key;
                                if (val != null) {
                                    dataPrint += `<p>
                                    <b style="color: #3498db; width: 100px; display: inline-block;">${ucWord(
                                        key
                                    )}</b>
                                    <span style="color: #555;">${val}</span>
                                </p>`;
                                }
                            }
                        });
                        modal.find(".modal-body").html(dataPrint);
                    }
                }
            },
            beforeSend: function() {}
        });
    });
});
