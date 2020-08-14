$(function() {
    function ucWord(str) {
        str = str.replace('_', ' ');
        str = str.replace('-', ' ');
        let strArray = str.split(" "),
            newStr = [];
        strArray.forEach(function(item) {
            newStr.push(
                item.replace(item.charAt(0), item.charAt(0).toUpperCase())
            );
        });
        return newStr.join(" ");
    }
    $(".view-company").on("click", function(e) {
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
                var status = data.status,
                    company = data.data;
                if (status === true) {
                    if (company != null) {
                        var dataPrint = "",
                            exceptColumn = [
                                "sort",
                                "user",
                            ];
                        $.each(company, function(key, val) {
                            if (exceptColumn.indexOf(key) == -1) {
                                key = key == 'user_id' ? 'Username' : key;
                                if (val != null) {
                                    val = key == 'company_logo' ? '<img src="' + val + '" width="150">' : val;
                                    dataPrint += `<p>
                                                <b style="color: #3498db; width: 120px; display: inline-block;">${ucWord(key)}</b>
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
