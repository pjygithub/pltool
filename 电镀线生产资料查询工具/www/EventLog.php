<?php
// 关闭报错
include(dirname(__DIR__) . '/www/function/close_debuger.php');
// 载入公共配置
include(dirname(__DIR__) . '/www/config/common_config.php');
// 机台号预处理
include(dirname(__DIR__) . '/www/function/using_machine.php');
// 输出机台选择信息
// echo '<pre>';
// print_r($machines_arr[$index]);
// echo '</pre>';
// 判断机台是否存在某个文件夹
$dirname = 'EventLog';
include(dirname(__DIR__) . '/www/function/isexistDIR.php');
// 列出选定的日期、月份、年份
include(dirname(__DIR__) . '/www/function/Dates.php');
$Dates = Dates('Y-m');
// echo '<pre>';
// print_r($Dates);
// echo '<pre>';

// 打开并返回数据流 $data
$format_normal = '_event';
$format_rsa = 'Rsa_';
include(dirname(__DIR__) . '/www/function/get_data.php');
$data = get_data_lines($Dates, $dirname, $format_normal, $format_rsa);
// echo '<pre>';
// print_r($data);

// //表头去重
// if (isset($data_lines[0]) and strlen($data_lines[0]) > 0 and $data_lines[0] != "") {
//     for ($j = 1; $j < count($data_lines); $j++) {
//         if ($data_lines[$j] == $data_lines[0]) {
//             unset($data_lines[$j]);
//         }
//         if ($data_lines[$j] == "") {
//             unset($data_lines[$j]);
//         }
//     }
// }
// $data_lines = array_values($data_lines); // 重新编号
// // var_dump($data_lines);
// $data = array();
// for ($i = 0; $i < count($data_lines); $i++) {
//     if (isset($data_lines[$i]) and strlen($data_lines[$i]) > 0 and $data_lines[$i] != "") {
//         $row = explode(",", $data_lines[$i]);
//         array_push($data, $row);
//     }
// }
// 定义显示的数据源(表头)
$tbheader = array(
    "﻿Time", "Time",
    "line",
    "Line",
    "Pump",
    "Run",
    "Mode",
    "Event",
    "event",
    "Code",
    "Other",

);
$used_ = array_merge($tbheader);
$arr_used = array();
for ($i = 0; $i < count($data[0]); $i++) {
    if (!array_search($data[0][$i], $used_, TRUE)) {
        array_push($arr_used, $data[0][$i]);
    }
}
if (isset($_COOKIE['model']) and $_COOKIE['model'] == 'debuger') {
    $tbheader = $arr_used;
}
$cols = array();
// 根据表头获取$data索引
for ($i = 0; $i < count($data[0]); $i++) {
    for ($j = 0; $j < count($tbheader); $j++) {
        $r = array_search($tbheader[$j], $data[0], true);
        if (is_int($r)) {
            array_push($cols, $r);
        }
    }
}
// 表头数组消重
$cols = array_unique($cols);
$cols = array_values($cols);
// echo "<pre>";
// var_dump($data);
// echo "</pre>";
// die;
// 按需加载
if (isset($_COOKIE['lang']) and $_COOKIE['lang'] == 'en') {
    include(dirname(__DIR__) . '/www/language/lang.en.php'); //英文语言文件
} else {
    include(dirname(__DIR__) . '/www/language/lang.zh_CN.php'); //中文语言文件
}
// 按需加载
if (isset($_COOKIE['show']) and $_COOKIE['show'] == "table" or $_COOKIE['model'] == 'zh_help') {
    include(dirname(__DIR__) . '/www/viewer/table.php');
} elseif (!isset($_COOKIE['model']) or $_COOKIE['model'] != 'debuger') {
    include(dirname(__DIR__) . '/www/viewer/table.php');
} else {
    include(dirname(__DIR__) . '/www/viewer/echart.php');
}
