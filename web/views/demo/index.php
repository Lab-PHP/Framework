This is a test
<?php 
echo URL::to('test');
echo URL::base_url();
echo "<pre>";
print_r($demo);
echo "</pre>";
die(__FILE__ . ' - In line - ' . __LINE__);