<?php
// 设置请求头和时区
ini_set('user_agent', 'Linux W-Get Monitor2 index.php set');
ini_set('date.timezone', 'Asia/Shanghai');
// 跳过证书验证
stream_context_set_default([
    'ssl' => [
        'verify_host' => false,
        'verify_peer' => false,
        'verify_peer_name' => false,
    ],
]);
function url_exist($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT_MS, 2000);
    if (curl_exec($ch) !== FALSE) {
        return true;
    } else {
        return false;
    }
}
function toUrldecode($str)
{
    $r = $str;
    $arr = array(
        '#' => '%23',
        '%' => '%25',
        '&' => '%26',
        '+' => '%2B',
        '/' => '%2F',
        '\\' => '%5C',
        '=' => '%3D',
        '?' => '%3F',
        ' ' => '%20',
        '.' => '%2E',
        ':' => '%3A',
        '!' => '%21',
        '*' => '%2A',
        '"' => '%22',
        "'" => "%27",
        '(' => '%28',
        ')' => '%29',
        ';' => '%3B',
        '@' => '%40',
        '&' => '%26',
        ',' => '%2C',
        '?' => '%3F',
        '[' => '%5B',
        ']' => '%5D',
        '<' => '%3C',
        '>' => '%3E',
        '~' => '%7E',
        '`' => '%60',
        '$' => '%24',
        '^' => '%5E',
        // '-' => '',
        // '_' => '',
        '{' => '%7B',
        '}' => '%7D',
        '|' => '%7C'
    );
    foreach ($arr as $key => $value) {
        $r = str_replace($key, $value, $r);
    }
    return $r;
}
// 状态显示访问用户资料
// $status_name = 'aam-intl\p02public2';
$status_name = "aam-intl\p02public";
$status_name = toUrldecode($status_name);
$status_password = "P02369258147";
$status_password = toUrldecode($status_password);
$status_url = "amcnts19.amcex.asmpt.com/PltLinestate/ViewState.aspx";
$echartShowTime = 450;
$ebotime10 = 2.5;
$ebotime12 = 6;
$ebotime31 = 2.5;
$ebotime38 = 6;
$ebotimeRSA = 6;
$ebotimeOther = 6;
$titleSort = 0; //筛选项排序，2为升排序，1为降排序，0为不排序；
$echartShowFloatNum = 1;
$tableLicensekey = "non-commercial-and-evaluation";
$echartSort = "seriesDesc";
$Release = 0; //1为发行版，0为测试版