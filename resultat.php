<?php
session_start();

echo("tout est ok!");
unset($_SESSION["error"]);
unset($_SESSION["alert"]);