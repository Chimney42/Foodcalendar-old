<?php

class Date {

    public function getTimespan(DateTime $older, DateTime $newer) {

        $Y1 = $older->format('Y');
        $Y2 = $newer->format('Y');
        $Y = $Y2 - $Y1;

        $m1 = $older->format('m');
        $m2 = $newer->format('m');
        $m = $m2 - $m1;

        $d1 = $older->format('d');
        $d2 = $newer->format('d');
        $d = $d2 - $d1;

        if($d < 0) {
            $m = $m - 1;
            $d = $d + $this->_getDaysPreviousMonth($m2, $Y2);
        }
        if($m < 0) {
            $Y = $Y - 1;
            $m = $m + 12;
        }
        $timespan = array();
        $timespan['years'] = $Y;
        $timespan['months'] = $m;
        $timespan['days'] = $d;
        return $timespan;
    }

    protected function _getDaysPreviousMonth($currentMonth, $currentYear) {

        $previousMonth = $currentMonth - 1;
        if($currentMonth == 1) {
            $currentYear = $currentYear - 1;
            $previousMonth = 12;
        }
        if ($previousMonth == 11 || $previousMonth == 9 || $previousMonth == 6 || $previousMonth == 4) {
            return 30;
        } elseif ($previousMonth == 2) {
            if(($currentYear % 4) == 0) {
                return 29;
            } else {
                return 28;
            }
        } else {
            return 31;
        }
    }

    protected function _createTimespan($Y, $m, $d) {

        $timespan = '';
        $firstDiff = false;
        if($Y >= 1) {
            $firstDiff = true;
            $timespan .= $this->_pluralize($Y, 'year').' ';
        }
        if($m >= 1 || $firstDiff) {
            $firstDiff = true;
            $timespan .= $this->_pluralize($m, 'month').' ';
        }
        if($firstDiff) {
            $timespan .= 'and ';
        }
        $timespan .= $this->_pluralize($d, 'day');
        return $timespan;
    }

    protected function _pluralize($count, $text) {
        return $count . (($count == 1) ? ("$text") : ("${text}s"));
    }
}