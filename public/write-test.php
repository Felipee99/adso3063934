<?php
$path = __DIR__ . '/images/test-from-web.txt';
$result = @file_put_contents($path, "written by web at " . date('c') . PHP_EOL);
if ($result === false) {
    echo 'failed: ' . json_encode(error_get_last());
} else {
    echo 'ok, bytes=' . $result;
}
