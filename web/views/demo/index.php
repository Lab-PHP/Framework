<?php 
echo "<br>";
echo URL::base_url();
echo "<br>";
echo URL::create_action_url('demo/index');

echo "<pre>";
print_r($demo);
echo "</pre>";
die(__FILE__ . ' - In line - ' . __LINE__);