<?php
function dateActive($date_start,$date_finish)
{
    $arDateStart = explode(' ',$date_start);
    $arDateFinish = explode(' ',$date_finish);

    $arDateStart = explode('.',$arDateStart[0]);//[0]-d [1]-m [2]-Y
    $arDateFinish = explode('.',$arDateFinish[0]);

    $result = '';

    if((int)$arDateStart[2] != (int)$arDateFinish[2])
    {
        $result = $arDateStart[0].' '.FormatDate("F", MakeTimeStamp($date_start)).' '.$arDateStart[2].' - '.$arDateFinish[0].' '.FormatDate("F", MakeTimeStamp($date_finish)).' '.$arDateFinish[2];
    }
    else
    {
        $result = $arDateStart[0].' '.FormatDate("F", MakeTimeStamp($date_start)).' - '.$arDateFinish[0].' '.FormatDate("F", MakeTimeStamp($date_finish)).' '.$arDateFinish[2];
    }
    return $result;
}
function dateActiveFrom($date)
{
    $arDateStart = explode(' ',$date);

    $arDateStart = explode('.',$arDateStart[0]);//[0]-d [1]-m [2]-Y

    $result = $arDateStart[0].' '.FormatDate("F", MakeTimeStamp($date)).' '.$arDateStart[2];

    return $result;
}