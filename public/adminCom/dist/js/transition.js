$(function () {
    
    
    // all vars 
    let getSubAccounts = [],
        subAccounts = [],
        form = $('.form-transition'),
        table = form.find('#table-add-transition'),
        urlAccountTypes = table.attr('data-url-account-types'),
        btnAddRow = form.find('.add-row'),
        rowStandard = table.attr('data-row-standard'),
        btnSubmit = form.find('.btn-submit'),
        showMessages = form.find('.show-messages'),
        inputAmount = form.find('.amount'),
        optionsSubAccount = '',
        patternAmount = /^[0-9]{0,10}\.?[0-9]{1}?/,
        array_ids_deleted_when_update = [];
        
    
    // show error if amount invalid
    
    form.on('input', '.amount', function () {
        var matches = patternAmount.exec($(this).val());
        if (matches != null) {
            // if incorrect 
            if (matches[0] != matches.input) {
                $(this).next('.show-error-amount').html('Amount is invalid.');
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        } else {
            $(this).next('.show-error-amount').html('Amount is invalid.');
            $(this).addClass('is-invalid');
        }
    });
    
    // get account types and sub accounts
    
    $.ajax({
        url: urlAccountTypes,
        dataType: "json",
        type: "post",
        cache: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        success: function(response) {
            getSubAccounts = response.data;
            
            // on change account type > append option in select account name when edit or add transition
            
            form.on('change', '.account_type', function () {
                let selectAccountType = $(this),
                    selectSubAccount = selectAccountType.parent('td').siblings('td').find('.sub_account'),
                    accountTypeId = selectAccountType.val();
                
                subAccounts = [];
                $.each(getSubAccounts, function (key, val) {
                    if (val.account_type_id == accountTypeId) {
                        subAccounts.push({id: val.id, name: val.name});
                    }
                });
                optionsSubAccount = '';
                $.each(subAccounts, function (key, val) {
                    optionsSubAccount += '<option value="'+ val.id +'">' + val.name + '</option>';
                });
                selectSubAccount.html(optionsSubAccount);
            });
            
            // on load page append option in select account name when edit transition
            
            form.find('.account_type').each(function () {
                let $this = $(this),
                    selectSubAccount = $this.parent('td').siblings('td').find('.sub_account'),
                    accountTypeId = $this.val();
                
                subAccounts = [];
                $.each(getSubAccounts, function (key, val) {
                    if (val.account_type_id == accountTypeId) {
                        subAccounts.push({id: val.id, name: val.name});
                    }
                });
                optionsSubAccount = '';
                $.each(subAccounts, function (key, val) {
                    optionsSubAccount += '<option value="'+ val.id +'">' + val.name + '</option>';
                });
                selectSubAccount.html(optionsSubAccount);
            });
        }
    });
    
    // add row accounting
    
    btnAddRow.on('click', function () {
        $(rowStandard).insertBefore(table.find('tbody tr:last-child'));
    });
    $('#description').focus(function () {
        $(this).addClass('plus-row-active');
    }).blur(function () {
        $(this).removeClass('plus-row-active');
    });
    $(window).on('keyup', function (e) {
        if (!$('#description').hasClass('plus-row-active')) {
            if (e.keyCode === 107) {
                $(rowStandard).insertBefore(table.find('tbody tr:last-child'));
            }
        }
    });
    
    // hide btn remove from fisrt row and secound row
//    form.filter('.edit-transition').find('tr').filter(':first-child, :nth-of-type(2)').find('.remove-row').remove();
    
    
    // remove row accounting
    
    table.on('click', '.remove-row', function () {
        // save id in array deleted when update
        if (form.hasClass('edit-transition')) {
            var id = $(this).attr('data-id');
            if (id != 0) {
                array_ids_deleted_when_update.push(id);
            }
        }
        
        if (table.find('tbody tr').length > 3) {
            $(this).parents('tr').fadeOut(300, function () {
                $(this).remove();
            });
        }
    });
    
    // insert transition by ajax to database
    form.on('submit', function (e) {
        e.preventDefault();
        let dataForm = form.serialize(),
            url = form.attr('action'),
            dataAjax = {
                url: url,
                dataType: "json",
                type: "post",
                data: dataForm + '&delete_ids=' + array_ids_deleted_when_update.join(','),
                cache: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function (response) {
                    btnSubmit.find('.loading').fadeOut();
                    if (response.status == true) {
                        swal({
                            text: response.message,
                            icon: 'success',
                            timer: 3000,
                            button: false,
                        });
                        showMessages.find('.error').html(response.linkShowAll);
                        showMessages.removeClass('alert-danger').addClass('alert-success').slideDown(400);
                        if (form.hasClass('add-transition')) {
                            table.find('tbody').find('tr').not(':first-child, :nth-of-type(2), :last-child').fadeOut(400, function () {
                                $(this).remove();
                            });
                            form[0].reset();
                        }
                    }
                },
                beforeSend: function () {
                    btnSubmit.find('.loading').fadeIn();
                },
                error: function (errors, exp) {
                    if (exp == 'error') {
                        btnSubmit.find('.loading').fadeOut();
                        var error_array = errors.responseJSON.errors,
                            errors_print = '';
                        $.each(error_array, function (k, val) {
                            errors_print += val[0] + '<br>';
                        });
                        showMessages.find('.error').html(errors_print);
                        showMessages.removeClass('alert-success').addClass('alert-danger').slideDown(400);
                    }
                }
            };
        $.ajax(dataAjax);
    });
    
    // hide alert message
    
    showMessages.find('.close').on('click', function () {
        $(this).parent().slideUp(400);
    });
    
});
        
        
        
        
        
        
        
        
        
        