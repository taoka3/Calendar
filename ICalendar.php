<?php
interface ICalendar
{
    public function makeHtmlTable(string $date,int $dateInterval,int $timeInterval);
    public function makeHtmlTableHead(string $date,int $dateInterval,int $timeInterval):string;
    public function makeHtmlTableBody(string $date,int $dateInterval,int $timeInterval):string;
    public function getReservedData():array;
    public function getHtml(string $date='2025-09-01',int $dateInterval=7,int $timeInterval=10):string;
}