function testIntersectionDate(userDate1, userDate2, intervalDate1, intervalDate2) {
    if ( +userDate1 > +userDate2) { return false; }
    do {
        if ( +userDate1 >= +intervalDate1 && +userDate1 <= intervalDate2) {
            return true;
        }
        userDate1.setDate( userDate1.getDate() + 1);
    } while (+userDate1 <= +userDate2);
    return false;
}
function rememberRoom(number) {
    if (window.localStorage) {
        localStorage['room'] = number;
    }
}
function getMin(array) {
    console.log(array);
    array = array || null;
    if (array.length) {
        var min = +array[0];
        for (var i = 0; i < array.length; i++) {
            min = ( +array[i] < min) ? +array[i] : min;
        }
        return min;
    } else {
        return false;
    }
}
function getMax(array) {
    array = array || null;
    if (array.length) {
        var max = +array[0];
        for (var i = 0; i < array.length; i++) {
            max = (+array[i] > max) ? +array[i] : max;
        }
        return max;
    } else {
        return false;
    }
}

if (window.localStorage) {
    (function($) {
        $(function() {
            var $datepicker = $('.datepicker'),
                    $date1 = $('#date1'),
                $date2 = $('#date2');

            $date1.change(function() {
                $date2.datepicker('option', 'minDate', new Date( Date.parse( $(this).val() )));
            });

            $datepicker.change(function() {
                localStorage[ $(this).attr('id') ] = $(this).val();
            });



            if ( localStorage['date1'] ) {
                $date1.val( localStorage['date1']);
            }
            if ( localStorage['date2'] ) {
                $date2.val( localStorage['date2'] );
            }

            setTimeout(function() {
                $date2.datepicker('option', 'minDate', new Date( Date.parse( $date1.val() )));
            }, 0);

            $('select#room').val( localStorage['room'] );

        });
    })(jQuery);
}