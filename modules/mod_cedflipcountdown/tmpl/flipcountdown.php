<?php
/**
 * @package     CedFlipCountdown
 * @subpackage  com_cedflipcountdown
 * http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL 3.0</license>
 * @copyright   Copyright (C) 2013-2016 galaxiis.com All rights reserved.
 * @license     The author and holder of the copyright of the software is Cédric Walter. The licensor and as such issuer of the license and bearer of the
 *              worldwide exclusive usage rights including the rights to reproduce, distribute and make the software available to the public
 *              in any form is Galaxiis.com
 *              see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;


$tilldate = $params->get('tilldate', '1/01/2015 00:00:01');
$flipmode = $params->get('flipmode', 'hours');

$uuid = uniqid();
$speed = "speedFlip:".$params->get('speedanimateflip', 100);

$size = $params->get('size', "lg");

$psize= "size:'md'";
if ($size == 'lg') {
    $psize= "size:'lg'";
} else if ($size == 'sm') {
    $psize= "size:'sm'";
} else if ($size == 'xs') {
    $psize= "size:'xs'";
}

$hoursParameters = array($params->get('ampmformat', 'am:false'),
    $speed,
    "tzoneOffset:".$params->get('offsettimezone', 0),
    $params->get('hidehours', 'showHour:true'),
    $params->get('hideminutes', 'showMinute:true'),
    $params->get('hideseconds', 'showSecond:true'),
    $psize
);
$hoursParameters = implode(",", $hoursParameters);

$counterParameters = array(
    $speed,
    $params->get('size', 'size:\'lg\'')
);
$counterParameters = implode(",", $counterParameters);

if ($flipmode == "hours") {
    ?>

    <script>
        jQuery(function ($) {
            $('#retroclockbox-<?php echo $uuid; ?>').flipcountdown({<?php echo $hoursParameters ?>});
        })
    </script>

<?php
} else if ($flipmode == "counter") {
    ?>
    <script>
        jQuery(function ($) {
            var i = 1;
            $('#retroclockbox-<?php echo $uuid; ?>').flipcountdown({
                tick: function () {
                    return i++;
                }
            });
        })
    </script>
<?php
} else if ($flipmode == "tilldate") { ?>

<script>
jQuery(function($){
    var NY = Math.round((new Date('<?php echo $tilldate; ?>')).getTime()/1000);
    $('#retroclockbox-<?php echo $uuid; ?>').flipcountdown({
			tick:function(){
        var nol = function(h){
            return h>9?h:'0'+h;
        }
				var	range  	= NY-Math.round((new Date()).getTime()/1000),
					secday = 86400, sechour = 3600,
					days 	= parseInt(range/secday),
					hours	= parseInt((range%secday)/sechour),
					min		= parseInt(((range%secday)%sechour)/60),
					sec		= ((range%secday)%sechour)%60;
				return nol(days)+' '+nol(hours)+' '+nol(min)+' '+nol(sec);
			}, <?php echo $hoursParameters ?>
		});
	});
</script>
<?php
}

?>

<div class="custom<?php echo $moduleclass_sfx ?>"
<!-- Copyright (C) 2013-2016 galaxiis.com All rights reserved. -->

<div id="retroclockbox-<?php echo $uuid; ?>"></div>

<div style="text-align: center;">
    <a href="https://www.galaxiis.com"
       style="font: normal normal normal 10px/normal arial; color: rgb(187, 187, 187); border-bottom-style: none; border-bottom-width: inherit; border-bottom-color: inherit; text-decoration: none; "
       onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'"
       target="_blank"><strong>cedflipcountdown</strong></a>
</div>

</div>
