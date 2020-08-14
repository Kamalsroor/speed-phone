Date.prototype.addDays = function(days) {
    var date = new Date(this.valueOf());
    date.setDate(date.getDate() + days);
    return date;
}

$(function () {
    $('#expire_time').on('input', function () {
        var inputDate = $('#date_expire'),
            days = isNaN($(this).val().trim()) ? false : parseInt($(this).val()),
            dateNow = new Date();
        if (days != false) {
            var dateExpired = dateNow.addDays(days);
            if (dateExpired != 'Invalid Date') {
                var month = (dateExpired.getMonth() + 1) < 10 ? '0' + (dateExpired.getMonth() + 1) : (dateExpired.getMonth() + 1);
                    day = dateExpired.getDate() < 10 ? '0' + dateExpired.getDate() : dateExpired.getDate(),
                    hours = dateExpired.getHours() < 10 ? '0' + dateExpired.getHours() : dateExpired.getHours(),
                    minutes = dateExpired.getMinutes() < 10 ? '0' + dateExpired.getMinutes() : dateExpired.getMinutes(),
                    seconds = dateExpired.getSeconds() < 10 ? '0' + dateExpired.getSeconds() : dateExpired.getSeconds();
                var datestring = 
                    dateExpired.getFullYear()  + '-' + 
                    month + '-' +
                    day + ' ' +
                    hours + ':' +
                    minutes + ':' +
                    seconds;
                inputDate.val(datestring);
            }
        }
    });
});