<?php
exec("python /public_html/request.py",$out,$status);
echo "class : ".$out[0]."<br>";
echo "score : ".$out[1]."<br>";
echo "position : ".$out[2];
?>
