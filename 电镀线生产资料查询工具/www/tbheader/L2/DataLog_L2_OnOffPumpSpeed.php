<?
$DataLog_L2_OnOffPumpSpeed = array();
$db_file = dirname(__DIR__) . "../../config/db_datalog_table_pltool.sqlite3";
$db_handle = new SQLite3($db_file);
// 检测连接是否成功
if (!$db_handle) {
    die("数据库连接失败: " . $db_handle->lastErrorMsg());
}
// 执行SQL语句
$sql = 'SELECT * FROM `tb_tbheader` WHERE `L2` = "1" AND `type` IN ("0","4","5")';
$DataLog_L2_OnOffPumpSpeed = array();
$results_nick_col = $db_handle->query($sql);
while ($row = $results_nick_col->fetchArray()) {
    $tbheader = $row["tbheader"];
    array_push($DataLog_L2_OnOffPumpSpeed, $tbheader);
}
// var_dump($DataLog_L2_OnOffPumpSpeed);
$db_handle->close();
$tbheader = $DataLog_L2_OnOffPumpSpeed;
