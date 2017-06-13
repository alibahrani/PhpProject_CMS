<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layout/header.php"); ?>

<?php 
    find_selected_page();
?>

<div id="main">
    <div id="navigation">
       <?php echo navigation($selected_subject_id, $selected_page_id); ?> 
        <br />
        <a href="new_subject.php">+ Add subject</a>
        
    </div>
    <div id="page">
        <?php 
            echo message();
        ?>
        <?php if($current_subject){?>
            <h2>Manage Subject</h2>
            Menu name: <?php echo $current_subject["menu_name"]; ?> <br/>
        <a href="edit_subject.php?subject=<?php echo $current_subject["id"]; ?>">Edit Subject</a>
        <?php } else if ($current_page){?>
                    <h2>Manage Page</h2>
                    Menu name: <?php echo $current_page["menu_name"]; ?> <br/>
        <?php }else {?>
        plase select page 
        <?php }?>
    </div>
</div>

<?php include("../includes/layout/footer.php"); ?>
