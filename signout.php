<?php
require_once "Config/functions.php";
 session_start();
 session_unset();
 session_destroy();
 redirect("../Signin.php?error=none");
