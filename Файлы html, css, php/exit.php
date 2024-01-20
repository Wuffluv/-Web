<?php

setcookie('user', $email['email'], time() - 3600, "/"); 
header('Location: /');

?>