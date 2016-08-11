<?php

defined('_JEXEC') or die('Rescrict access');

$db = & JFactory::getDbo();
$allRooms = array();
$prices = array();
$today = date("Y-m-d 00:00:00");
$room_count = array();
$bedrooms_count = array();
$levels = array();

$query = "SELECT con.images, con.alias, r.id, r.nubmer, r.rooms_count, r.bedrooms_count, r.level, r.article, r.view
FROM #__rooms as r  JOIN #__content as con
ON con.id = r.article WHERE r.published = 1 ORDER BY r.nubmer ASC";
$db->setQuery($query);
$list = $db->loadObjectList();
foreach ($list as $room) {
    $arr = array(
        'room' => $room,
        'clients' => array(),
        'price' => array(),
    );
    $room_count[] = $room->rooms_count;
    $bedrooms_count[] = $room->bedrooms_count;
    $levels[] = $room->level;
    // get clients
    $clientsQuery = "SELECT * FROM #__clients WHERE published = 1 AND rooms_id = {$room->nubmer} AND date2 >= '{$today}' ";
    $db->setQuery($clientsQuery);
    $clientsList = $db->loadObjectList();
    foreach ($clientsList as $client) {
        $arr['clients'][] = $client;
    }
    //var_dump($room->nubmer);
    // get price
    $priceQuery = "SELECT * FROM #__price WHERE published = 1 AND rooms_id = {$room->nubmer} AND date2 > '{$today}' ";
    $db->setQuery($priceQuery);
    $priceList = $db->loadObjectList();
    foreach ($priceList as $price) {
        $arr['price'][] = $price;
        $prices[] = $price->price;
    }
    $allRooms[ $room->nubmer ] = $arr;
}
$room_count = array_unique($room_count);
$bedrooms_count = array_unique($bedrooms_count);
$levels = array_unique($levels);

sort($room_count);
sort($bedrooms_count);
sort($levels);
?>
<script type="text/javascript" src="/modules/mod_booking/script_booking.js"></script>
<link type="text/css" rel="stylesheet" href="/modules/mod_booking/style_booking.css" />
<?php
$obj =  json_encode($allRooms);
$prices = array(0 =>  min($prices), 1 => max($prices));
$minEndMax = json_encode($prices);

?>
<script>
    var rooms = <?php  echo $obj; ?>;
         minEndMax = <?php echo $minEndMax; ?>;
</script>
<div class="mod_booking">
    <a class="reset uk-button" id="reset"><i class="uk-icon-times"></i> Сбросить фильтры</a>
    <form id="rooms-form" class="uk-form rooms-form">
        <table class="slider-table">
            <tr>
                <td>
                    <label>
                        Дата заезда:
                        <input type="text" class="datepicker" name="date1" id="date1" />
                    </label>
                </td>
                <td>
                    <label>
                        Дата выезда:
                        <input type="text" class="datepicker" name="date2" id="date2" />
                    </label>
                </td>

                <td>
                    <label>
                        Количество комнат:
                        <select id="rooms_count" name="rooms_count">
                            <option value="0">Неважно</option>
                            <?php foreach ($room_count as $count): ?>
                                <option value="<?php echo $count; ?>"><?php echo $count; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                    Цена руб.РФ:
                    <label>
                        От: <input value="<?php echo $prices[0]; ?>"  style="width: 80%;" type="text" name="price1" id="price1" />
                    </label>
                </td>
                <td>
                    <label>
                        До: <input value="<?php echo $prices[1]; ?>" style="width: 80%;" type="text" name="price2" id="price2" />
                    </label>
                </td>
                <td>
                    <label>
                        Количество спальных мест:
                        <select id="bedrooms_count" name="bedrooms_count">
                            <option value="0">Неважно</option>
                            <?php foreach ($bedrooms_count as $count): ?>
                                <option value="<?php echo $count; ?>"><?php echo $count; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div id="slider"></div>
                </td>
                <td>
                    <label>
                        Этаж:
                        <select id="level" name="level">
                            <option value="0">Неважно</option>
                            <?php foreach ($levels as $level): ?>
                                <option value="<?php echo $level; ?>"><?php echo $level; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </td>
            </tr>
        </table>
    </form>

    <div id="rooms-list"></div>
</div>
<style>
    .reset {
        position: absolute;
        right: 156px;
        top: 12px;
    }

    .item-button {
        position: absolute;
        bottom: 0;
    }
    .table-item td {
        vertical-align: top;
        position: relative;
    }

    .slider-table td {
        padding: 5px 10px;
        text-align: right;
    }
    .slider-table td input {
        width: 100px !important;
    }
    .slider-table tr td:last-child {
        padding-left: 80px;
    }

    .rooms-form {
        /*border-bottom: 2px dashed;*/
        padding-bottom: 30px;
        margin: 10px 0 30px 0;
    }

    /*квартиры*/
    .main-div {
        width: 100%;
        min-height: 170px;
        padding: 10px 5px;
        /*border: 2px dashed rgba(0,0,0,0.2);*/
        /*margin-bottom: 10px;*/
        opacity: 0.4;

        -webkit-transition: all 0.8s ease;
        -moz-transition: all 0.8s ease;
        -o-transition: all 0.8s ease;
        transition: all 0.8s ease;
        border: 1px solid rgba(0,0,0,0);

        box-sizing: border-box;
        -moz-box-sizing: border-box; /*Firefox 1-3*/
        -webkit-box-sizing: border-box; /* Safari */

    }
    .main-div:hover {
        background-color: #F0FAFC;
        /*border: 2px dashed #fff;*/
        border: 1px solid #ddd;
        box-shadow: 4px 4px 10px rgba(0,0,0,0.3);
    }
    .uk-overlay-area {
        background: rgba(0,0,0,0.3) !important;
    }
    .main-div-item {
        float: left;
        padding: 10px;
    }
    .main-div-item.button-div-right {
        padding: 15px;
    }
    .div-img {
        width: 170px;
        overflow: hidden;
        border: 1px solid #ddd;
        border-radius: 10px;
        background-color: #fff;
    }
    .text-block {

    }
    .text-block-title {
        font-weight: bold;
        font-size: 16px;
        text-decoration: underline;
    }
    .text-block-table {
        color: rgb(81, 84, 86);
    }
    .text-block-table tr td:first-child{
        text-align: right;
        padding-right: 10px;
    }
    .div-price {
        text-align: justify;
    }
    .price-value {
        font-weight: bold;
        font-size: 16px;
        color: #54aacb;
    }
    .button-div {
        width: 135px;
    }
    .button-div a {
        display: block;
        width: 100%;
        margin: 5px;
    }
</style>
<script>


    (function($) {
        $(function() {
            var $roomSearch = $('#room-search'),
                $roomsList = $('#rooms-list'),
                $date1 = $('#date1'),
                $date2 = $('#date2'),
                $slider = $('#slider'),
                $price1 = $('#price1'),
                $price2 = $('#price2'),
                $roomsCount = $('#rooms_count'),
                $bedroomsCount = $('#bedrooms_count'),
                $level= $('#level'),
                $reset = $('#reset'),
                $roomsForm = $('#rooms-form');


            $('.datepicker').datepicker({
                minDate: new Date(),
                dateFormat: 'yy.mm.dd'
            });



            function filterByClients(rooms) {
                for (var i in rooms) {
                    if ( $date1.val() && $date2.val() ) {
                        var userDate1 = new Date( Date.parse( $date1.val() ) ),
                            userDate2 = new Date( Date.parse( $date2.val() ) );
                        for (var j in rooms[i].clients) {
                            var intervalDate1 = new Date( Date.parse( rooms[i].clients[j].date1 ) ),
                                intervalDate2 = new Date( Date.parse( rooms[i].clients[j].date2 ) );
                            var test = testIntersectionDate(userDate1, userDate2, intervalDate1, intervalDate2);
                            //console.log(test);
                            if ( test == true ) {
                                rooms[i].show = false;
                            }
                        }
                    }
                }
            }
            // @price = array
            function getAllPrice(price) {
                var priceArray = [];
                for (var p = 0; p < price.length; p++) {
                    priceArray.push( price[p].price );
                }
                return priceArray;
            }
            // @price = array
            function getPriceByDate(price, userDate1, userDate2) {
                //console.log('getPriceByDate begin', price, userDate1, userDate2);
                var priceArray = [];
                do {
                    for (var i = 0; i < price.length; i ++) {
                        var priceDateInterval1 = Date.parse( price[i].date1),
                             priceDateInterval2 = Date.parse( price[i].date2 );
                        //console.log(priceDateInterval1, +userDate1, priceDateInterval2);
                        if ( (+userDate1 >= priceDateInterval1) && (+userDate1 <= priceDateInterval2)) {
                            priceArray.push( +price[i].price );
                        }
                    }
                    userDate1.setDate( userDate1.getDate() + 1);
                }
                while ( + userDate1 <= +userDate2);
                return priceArray;
            }

            function filterByPrice(rooms) {
                var minPrice = ( +$price1.val() );
                var maxPrice = ( +$price2.val() );
                for (var i in rooms) {
                    priceArray = getAllPrice(rooms[i].price);
                    //if ( (minPrice > minEndMax[0]) || (maxPrice < minEndMax[1]) ) {
                        if (rooms[i].show == true) {
                            rooms[i].show = false;
                            var date1 = Date.parse( $date1.val() );
                            var date2 = Date.parse( $date2.val() );
                            var priceArray;

                            if ( date1 && date2 && ( date1 <= date2 ) ) {
                                var userDate1 = new Date( date1),
                                    userDate2 = new Date( date2 );
                                priceArray = getPriceByDate(rooms[i].price, userDate1, userDate2);
                            }
                            // проверяем все цены
                            for (var pA = 0; pA < priceArray.length; pA++) {
                                if ( (priceArray[pA] >= minPrice) && (priceArray[pA] <= maxPrice) ) {
                                    rooms[i].show = true;
                                }
                            }
                        }
                    //}
                    // находим максимальную и минимальную цену
                    rooms[i].minPrice = getMin(priceArray);
                    rooms[i].maxPrice = getMax(priceArray);
                }
            }

            function filterByRooms(rooms) {
                var val = + $roomsCount.val();
                if (val) {
                    for (var i in rooms) {
                        if (rooms[i].show) {
                            var room_count = +rooms[i].room.rooms_count;
                            if (val != room_count) {
                                rooms[i].show = false;
                            }
                        }
                    }
                }
            }

            function filterByBedrooms(rooms) {
                var val = + $bedroomsCount.val();
                if (val) {
                    for (var i in rooms) {
                        if (rooms[i].show) {
                            var bedrooms_count = +rooms[i].room.bedrooms_count;
                            if (val != bedrooms_count) {
                                rooms[i].show = false;
                            }
                        }
                    }
                }
            }

            function filterByLevels(rooms) {
                var val = + $level.val();
                if (val) {
                    for (var i in rooms) {
                        if (rooms[i].show) {
                            var level = +rooms[i].room.level;
                            if (val != level) {
                                rooms[i].show = false;
                            }
                        }
                    }
                }
            }

            function showAllRooms(rooms) {
                $roomsList.html('');
                for (var i1 in rooms) {
                    rooms[i1].show = true;
                }
                filterByClients(rooms);
                filterByPrice(rooms);
                filterByRooms(rooms);
                filterByBedrooms(rooms);
                filterByLevels(rooms);


                for (var i in rooms) {
                    if (rooms[i].show) {
                        var url = '/rooms/' + rooms[i].room.article + '-' + rooms[i].room.alias
                            + '?nubmer=' + rooms[i].room.nubmer,
                            bookingUrl = '/booking/'
                                + '?nubmer=' + rooms[i].room.nubmer;
                        var images = JSON.parse(rooms[i].room.images);

                        // blocks

                        var $divPrice = $('<div/>', { 'class': 'div-price main-div-item' })
                            .append(
                            $('<div/>').html(
                                'Цены от: <span class="price-value">'
                                    + rooms[i].minPrice + '</span> руб&nbsp;&nbsp;&nbsp; До: <span class="price-value">'
                                    + rooms[i].maxPrice + '</span> руб'
                            )
                        )
                            .append(
                                $('<div/>', {'class': 'div-price-date'}).html(
                                    ($date1.val() && $date2.val()) ?
                                        'c ' + $date1.val() + ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;по: ' + $date2.val() :
                                        ''
                                )
                            );
                        var
                            $buttonDiv = $('<div/>', { 'class': 'main-div-item button-div'}),
                            $readMore = $('<a/>', { 'class': 'uk-button' , href: url }).text('Подробнее'),
                            $book = $('<a/>', { 'class': 'uk-button uk-button-success' , href: bookingUrl }).text('Забронировать');
                        $buttonDiv.append($readMore).append($book);

                        var
                            $buttonDivRight = $('<div/>', { 'class': 'main-div-item button-div-right'}),
                        $bookCount = $('<a/>', { 'class': 'uk-button uk-button-primary' , 'data-uk-modal': "{target:'#count'}" }).html(
                            '<i class="fa fa-calculator">'
                                + '</i>' + ' Онлайн<br> калькулятор');
                        $buttonDivRight.append($bookCount);

                        var
                            $img = $('<img/>', { src: images.image_intro, 'class' : 'room-image' }),
                            $a = $('<a/>', { href: url, 'class' : 'text-block-title' }).html( 'Апартаменты № ' + rooms[i].room.nubmer),
                            $textInfo = $('<div/>', { 'class': 'text-info' }).html(
                                '<table class="text-block-table"><tr>'
                                    + '<td>Количество комнат:' + '</td><td>'  + rooms[i].room.rooms_count + '</td>'
                                    + '</tr><tr>'
                                    + '<td>Количество спальных мест:' + '</td><td>' + rooms[i].room.bedrooms_count + '</td>'
                                    + '</tr><tr>'
                                    + '<td>Этаж:' + '</td><td>' + rooms[i].room.level + '</td>'
                                    + '</tr>'
                                    + '</table>'
                            ),
                            $aImg = $('<a/>', { href: url }).css({ display: 'block' }),
                            $mainDiv = $('<div/>', { 'class' : 'main-div' }),
                            $divImgDivItem = $('<div/>', { 'class' : 'div-img main-div-item' }),
                            $overLay = $('<div/>', { 'class': 'uk-overlay' }),
                            $before =$('<div/>', { 'class': 'uk-overlay-area' }),
                            $divTextBlock = $('<div/>', { 'class' : 'text-block main-div-item' });

                        // image
                        $overLay.append($img).append($before);
                        $aImg.append($overLay);
                        $divImgDivItem.append($aImg).appendTo($mainDiv);

                        // text-block
                        $divTextBlock.append($a).append($textInfo).appendTo($mainDiv);

                        // price-div
                        $divPrice.appendTo($mainDiv);

                        // buttons
                        $buttonDiv.appendTo($mainDiv);
                        $buttonDivRight.appendTo($mainDiv);

                        // вставляем в главный див
                        $roomsList.append($mainDiv);
                        $mainDiv.animate({opacity: 1}, 900);
                    }
                } // конец форича комнат
            }


            $roomSearch.click(function(e) {
                showAllRooms(rooms);
                //e.preventDefault();
                return false;
            });


            $slider.slider({
                min: +minEndMax[0],
                max: +minEndMax[1],
                values: [minEndMax[0], minEndMax[1]],
                range: true,
                stop: function() {
                    $price1.val( $slider.slider("values",0) );
                    $price2.val( $slider.slider("values",1) );
                    showAllRooms(rooms);
                },
                slide: function() {
                    $price1.val( $slider.slider("values",0) );
                    $price2.val( $slider.slider("values",1) );
                }
            });

            $price1.change(function(){
                var value1=$price1.val();
                var value2=$price2.val();

                if(parseInt(value1) > parseInt(value2)){
                    value1 = value2;
                    $price1.val(value1);
                }
                $slider.slider("values",0,value1);
            });


            $price2.change(function(){
                var value1=$price1.val();
                var value2=$price2.val();

                //if (value2 > 1000) { value2 = 1000; $price2.val(1000)}

                if(parseInt(value1) > parseInt(value2)){
                    value2 = value1;
                    $price2.val(value2);
                }
                $slider.slider("values",1,value2);
            });

            $('input, select', $roomsForm).change(function() {
                    showAllRooms(rooms);
            });
            showAllRooms(rooms);

            $reset.click(function() {
                $date1.val('');
                $date2.val('');
                $roomsCount.val(0);
                $bedroomsCount.val(0);
                $level.val(0);
                $price1.val(minEndMax[0]).trigger('change');
                $price2.val(minEndMax[1]).trigger('change');
                showAllRooms(rooms);
            });

// end function after  page load
        });
    })(jQuery);
</script>

