<?php

mysql_connect($server = 'localhost', $username = 'root', $password = 'root') or die ("impossible de se connecter: " . mysql_error());
mysql_select_db('blog');

?>