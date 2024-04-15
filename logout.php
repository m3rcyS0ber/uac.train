<?php
include "classes/Auth.php";
if(!Auth::isGuest()) {
   Auth::logout();
}
header("Location: index.php");