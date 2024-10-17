<?php
    include("functions.php");
    if (!isset($_SESSION)) session_start();
    include(HEADER_TEMPLATE);
	$index_result = index();
?>

<?php include("modal.php"); ?>
<?php include(FOOTER_TEMPLATE); ?>