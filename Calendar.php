<?php
require 'ICalendar.php';

class Calendar implements ICalendar
{
    public string $html = '';
    private string $startTime = "08:00";
    private string $endTime   = "23:50";

    public function getHtml(string $date = '2025-09-01', int $dateInterval = 7, int $timeInterval = 30):string
    {
        $this->html = '';
        $this->makeHtmlTable($date, $dateInterval, $timeInterval);
        return $this->html;
    }

    public function makeHtmlTable(string $date, int $dateInterval, int $timeInterval)
    {
        $this->html .= '<div class="relative overflow-x-auto">';
        $this->html .= '<table class="w-full text-sm text-left rtl:text-right text-gray-500">';
        $this->html .= $this->makeHtmlTableHead($date, $dateInterval, $timeInterval);
        $this->html .= $this->makeHtmlTableBody($date, $dateInterval, $timeInterval);
        $this->html .= '</table>';
        $this->html .= '</div>';
    }
    public function makeHtmlTableHead(string $date, int $dateInterval, int $timeInterval):string
    {
        $week = [ "日"=>'bg-red-800', "月"=>'bg-gray-800', "火"=>'bg-gray-800',
         "水"=>'bg-gray-800', "木"=>'bg-gray-800', "金"=>'bg-gray-800', "土"=>'bg-blue-800'];
        $str = '';
        $str .= '<thead class="text-white">';
        $str .= '<tr class="bg-gray-800 text-white border-b border-gray-700">';
        for ($i = 0; $i < $dateInterval; $i++) {
            $day = new DateTime("$date +$i day");
            $bgColor = array_values($week)[$day->format("w")];
            $str .= "<th class=\"px-6 py-3 text-left text-sm font-semibold border-b border-gray-700 {$bgColor}\">";
            $str .= $day->format('Y-m-d').'('.array_keys($week)[$day->format("w")].')';
            $str .= '</th>';
        }
        $str .= '</tr>';
        $str .= '</thead>';

        return $str;
    }

    public function makeHtmlTableBody(string $date, int $dateInterval, int $timeInterval):string
    {
        $str = '';

        $basicDay = new DateTime("$date");
        $interval = new DateInterval("PT{$timeInterval}M"); // X分
        $basicStart = DateTime::createFromFormat('Y-m-d H:i', $basicDay->format('Y-m-d') . ' ' . $this->startTime);
        $basicEnd   = DateTime::createFromFormat('Y-m-d H:i', $basicDay->format('Y-m-d') . ' ' . $this->endTime);
        $basicCurrent = clone $basicStart;

        $str .= '<tbody class="divide-y divide-gray-200">';
        while ($basicCurrent <= $basicEnd) {
            $str .= '<tr class="hover:bg-gray-50 transition">';

            for ($i = 0; $i < $dateInterval; $i++) {
                $day[$i] = $day[$i] ?? (new DateTime("$date +$i day"));
                $start[$i] = $start[$i] ?? (DateTime::createFromFormat('Y-m-d H:i', $day[$i]->format('Y-m-d') . ' ' . $this->startTime));
            }

            for ($i = 0; $i < $dateInterval; $i++) {
                $current[$i] = $current[$i] ?? (clone $start[$i]);
                $lock = in_array($current[$i]->format('Y-m-d H:i:s'),$this->getReservedData()) === false?'':'lock ';
                $str .= "<td data-draggable=\"false\" data-date=\"" . $current[$i]->format('Y-m-d H:i:s') . 
                "\" title=\"" . $current[$i]->format('Y-m-d H:i') ."\" class=\"{$lock}draggable px-6 py-4 text-sm text-gray-700\">";
                $str .= $current[$i]->format('H:i');
                $str .= "</td>";
            }

            for ($i = 0; $i < $dateInterval; $i++) {
                $current[$i]->add($interval);
            }

            $basicCurrent->add($interval);
            $str .= '</tr>';
        }
        $str .= '</tbody>';

        return $str;
    }

    public function getReservedData():array
    {
        //dummy data
        return ['2025-09-02 11:00:00', '2025-09-02 12:00:00'];
    }
}

