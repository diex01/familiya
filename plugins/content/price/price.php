<?php
/**
 * @copyright	Copyright (c) 2014 price. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

/**
 * Content - price Plugin
 *
 * @package		Joomla.Plugin
 * @subpakage	price.price
 */
class plgContentprice extends JPlugin {

	/**
	 * Constructor.
	 *
	 * @param 	$subject
	 * @param	array $config
	 */
	function __construct(&$subject, $config = array()) {
		// call parent constructor
		parent::__construct($subject, $config);
	}

    function onContentPrepare($context, &$article, &$params, $limitstart=0)
    {

        // options всех квартир
        preg_match_all('/(\[rooms_options\])/', $article->text, $matches);
        if (count($matches[1])) {
            foreach ($matches[1] as $i => $widget_id) {
                $output = "<select required='required' id='room' style='width: 100%;'
                name='room'>";

                $db = & JFactory::getDbo();
                $options = "SELECT * FROM #__rooms WHERE published = 1 ORDER BY nubmer";
                $db->setQuery($options);
                $optionsLitst = $db->loadObjectList();
                foreach ($optionsLitst as $option) {
                    $output .= "<option value='{$option->nubmer}'>№{$option->nubmer}</option>";
                }


                $output .= "</select>";
                $article->text = str_replace($matches[0][$i], $output, $article->text);
            }
        }




        if (isset($_REQUEST['nubmer']) && ((int) $_REQUEST['nubmer'])) {
            $script = "<script>rememberRoom({$_REQUEST['nubmer']})</script>";
            $article->text .= $script;
        }

        // прячем блок с фильтром - если это материал
        if (preg_match('/rooms\/\d+-\d+/', $_SERVER['REQUEST_URI'])) {
            $article->text .= '<script>
            (function($) {
                $(function() {
                    $(".mod_booking").closest(".tm-top-b").hide();
                    if ( $("#gobook").length === 0 ) {
                        var $button = $("<a/>", {
                        "class" : "uk-button uk-button-success",
                        id: "gobook",
                        href: "/booking",
                        style: "color: #fff;margin-top: -8px;height: 34px;"
                        }).text("Забронировать");
                        $(".uk-article-title").append( $button );
                    }

                });
            })(jQuery);
        </script>';
        } else {
            $article->text .= '<script>
            (function($) {
                $(function() {
                    $(".content-category").hide();
                });
            })(jQuery);
        </script>';
        }


        preg_match_all('/(\[price\])/', $article->text, $matches);
        if (count($matches[1])) {
            foreach ($matches[1] as $i => $widget_id) {
                if (isset($_REQUEST['nubmer']) && ((int) $_REQUEST['nubmer'])) {
                    // get price by room
                    $db = & JFactory::getDbo();
                    $today = date("Y-m-d 00:00:00");
                    $output = "
                    <div class='uk-alert'>
                    <h3 style='margin-bottom: 0;' class='uk-panel-title' data-uk-toggle='{target:\"#price_{$_REQUEST['nubmer']}\"}''>
                    <i class='uk-icon-home'></i>
                    Цены на апартаменты № {$_REQUEST['nubmer']}
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     <span style='cursor:pointer;text-decoration: underline;'>раскрыть</span>
                     <i style='cursor:pointer;' class='uk-icon-arrow-circle-down'></i>
                    </h3>
                    <table id='price_{$_REQUEST['nubmer']}' class='uk-table'><tr>
                    <th>Начало периода</th>
                    <th>Конец периода</th>
                    <th>Цена руб.РФ /сутки</th>
                    </tr>";
                    $priceQuery = "SELECT * FROM #__price WHERE published = 1 AND rooms_id = {$_REQUEST['nubmer']} AND date2 > '{$today}'  ORDER BY date1";
                    $db->setQuery($priceQuery);
                    $priceList = $db->loadObjectList();

                    foreach ($priceList as $price) {
                        $date1 = DateTime::createFromFormat('Y-m-d h:i:s', $price->date1)->format('d.m.Y');
                        $date2 = DateTime::createFromFormat('Y-m-d h:i:s', $price->date2)->format('d.m.Y');
                        $output .= "<tr>
                        <td>{$date1}</td>
                        <td>{$date2}</td>
                        <td>{$price->price}</td>
                        </tr>";
                    }
                    $output .= "</table></div>";
                } else {
                    $output = '';
                }
                $article->text = str_replace($matches[0][$i], $output, $article->text);
            }
        }


        return '';
    }
	
}