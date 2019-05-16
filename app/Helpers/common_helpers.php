
<?php
/**
 * Helper file made by author Vishnukumar.
**
 * Return a formatted Carbon date.
 *
 * @param  Carbon\Carbon $date
 * @param  string $format
 * @return string
 */

function humanize_date(Carbon\Carbon $date, $format = 'd F Y, H:i'): string
{
    return $date->format($format);
}


 function form_in($attr,$db_dat)
{

	if( old($attr) ){
			return old($attr);
	} elseif (  !empty( $db_dat ) && $db_dat->{$attr} ){
		 $db_dat->{$attr};
		return $db_dat->{$attr};
	}else{
		return '';
	}
}