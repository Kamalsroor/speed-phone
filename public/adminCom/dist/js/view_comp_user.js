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
    $(".view-comp-user").on("click", function(e) {
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
                                "user",
                                "company",
                            ];
                        
                        // if view user from companies users -- show company and user id with only admin 
                        
                        if ($this.hasClass('from-company')) {
                            exceptColumn.push('user_id', 'company_id');
                        }
                        $.each(company, function(key, val) {
                            if (exceptColumn.indexOf(key) == -1) {
                                
                                
//                                if (!$this.hasClass('from-company')) {
//                                    key = key == 'user_id' ? 'Username' : key;
//                                    key = key == 'company_id' ? 'Company' : key;
//                                }
                                if (val != null) {
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
