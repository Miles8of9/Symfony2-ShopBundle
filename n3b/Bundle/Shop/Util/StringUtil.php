<?php

namespace n3b\Bundle\Shop\Util;

class StringUtil
{
    static public function slugify($text)
    {
        $text = str_replace(' ', '_', $text);
		$text = str_replace('-', '_', $text);

		$text = preg_replace('/[^А-Яа-яёЁA-Za-z0-9_]/u', '', $text);

		return $text;
    }

    static public function numberEnding($number, $ending0, $ending1, $ending2) {

		$num100 = $number % 100;
		$num10 = $number % 10;

		if ($num100 >= 5 && $num100 <= 20) {
			return $ending0;
		} else if ($num10 == 0) {
			return $ending0;
		} else if ($num10 == 1) {
			return $ending1;
		} else if ($num10 >= 2 && $num10 <= 4) {
			return $ending2;
		} else if ($num10 >= 5 && $num10 <= 9) {
			return $ending0;
		} else {
			return $ending2;
		}
	}
}