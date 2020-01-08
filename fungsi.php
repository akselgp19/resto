<?php
if (!function_exists('format_money')) {
	function format_money($nominal){
		return 'Rp. ' . number_format($nominal, 0, ', ', '.');
	}
}


?>