<?php
session_start();
session_destroy();

header("location:../home?success=0");
?>