<?php

echo "Session ID: " . session_id() . "<br>";

echo "Session Variables:<br>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
?>