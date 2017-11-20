<?php
/**
 * @author 章小慢
 * @date 2017/11/20 18:27
 */

require "vendor/autoload.php";

unset($argv[0]);
$str = implode(" ", $argv);
$cfg = "";
if (ctype_digit($str)) {
    $last3 = substr($str, -3);
    $cfg = floor($last3 % 128 / 8 / 4);
} else {
    $last3 = substr((crc32(strtolower($str))), -3);
    $cfg = floor($last3 % 128 / 8 / 4);
}
$result = $cfg."_".floor($last3 % 128 / 8)."_".$last3 % 128;

$workflow = new \Alfred\Workflows\Workflow();

$workflow->result()
    ->uid('1')
    ->title('sharding ')
    ->subtitle($result)
    ->type('default')
    ->arg($result)
    ->valid(true)
    ->icon('icon.png')
    ->autocomplete($str);

echo $workflow->output();