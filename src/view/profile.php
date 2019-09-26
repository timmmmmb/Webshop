<?php
if(isset($_SESSION['user_id'])){
    echo 'welcome '.$_SESSION['user_name'];
}
?>
