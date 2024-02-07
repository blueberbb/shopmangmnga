<?php
include('./Admin/include/head.php'); 
include('./Admin/include/navbar.php'); 
include('./Admin/include/carousel.php'); 
$act = (isset($_GET['act']) ? $_GET['act'] : '');
if($act=='showbytype'){
    include('./Admin/include/cards_type.php'); 
}elseif ($act=='q'){
    include('./Admin/include/search.php'); 
}else{
    include('./Admin/include/cards.php'); 
}
include('./Admin/include/footer.php'); 

?>