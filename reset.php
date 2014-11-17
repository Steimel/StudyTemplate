<?php

session_start();
unset($_SESSION['study_user_id']);
header("Location: index.php");
exit;
