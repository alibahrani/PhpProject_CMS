
<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php 
    find_selected_page();
?>


<?php
    if(!$current_subject){
        //Subject ID was missing or invalid or subject couldnt be found in database
        redirect_to("manage_content.php");
    }

?>

<?php 

if(isset($_POST['submit'])){
    
    
    //validations 
    $required_fields = array("menu_name", "position", "visible");
    validate_presences($required_fields);
    
    $fields_with_max_lengths = array("menu_name" => 30);
    validate_max_lengths($fields_with_max_lengths);
    
    if (empty($errors)) {
		
		// Perform Update

		$id = $current_subject["id"];
		$menu_name = mysql_prep($_POST["menu_name"]);
		$position = (int) $_POST["position"];
		$visible = (int) $_POST["visible"];
	
		$query  = "UPDATE subjects SET ";
		$query .= "menu_name = '{$menu_name}', ";
		$query .= "position = {$position}, ";
		$query .= "visible = {$visible} ";
		$query .= "WHERE id = {$id} ";
		$query .= "LIMIT 1";
		$result = mysqli_query($connection, $query);
    if($result && mysqli_affected_rows($connection) == 1){
        $_SESSION["message"] = "Subject updated. ";
        redirect_to("manage_content.php");
    }else {
        $message = "Subject update failed ";
    }
}
  
    
}else {
 // this is probably a get request
    
    
}

?>


<?php include("../includes/layout/header.php"); ?>

<div id="main">
    <div id="navigation">
       <?php echo navigation($selected_subject_id, $selected_page_id); ?>  
    </div>
    <div id="page">
        <?php 
            if(!empty($message)){
                echo "<div class=\"message\">" . $message . "</div>";
            }
        ?>
       
        <?php echo form_errors($errors); ?>
        <h2>Edit Subject: <?php echo $current_subject["menu_name"]; ?></h2>
        <form action="edit_subject.php?subject=<?php echo $current_subject["id"]; ?>" method="post">
            <p>
               Menu Name: <input type="text" name="menu_name" value="<?php echo $current_subject["menu_name"]; ?>" /> 
            </p>
            <p>
                Position:
                <select name="position">
                    <?php 
                    $subject_set = find_all_subjects();
                    
                    $subject_count = mysqli_num_rows($subject_set);
                    for($count=1 ; $count <= $subject_count; $count++){
                        echo "<option value=\"{$count}\"";
                        if($current_subject["position"] == $count){
                            
                        echo " selected";
                        }
                        echo ">{$count}</option>";
                    }
    
                    ?>
                </select>
            </p>
            <p>Visible:
                <input type="radio" name="visible" value="0" <?php if($current_subject["visible"] == 0){ echo "checked";} ?>/>No &nbsp;
                <input type="radio" name="visible" value="1" <?php if($current_subject["visible"] == 1){ echo "checked";} ?> /> Yes
            </p>
            <input type="submit" name="submit" value="Edit Subject" />
        
        </form>
        <br/>
        <a href="manage_content.php">Cancel</a>
        &nbsp;
        &nbsp;
        <a href="delete_subject.php?subject=<?php echo $current_subject["id"] ?>" onclick="return confirm('Are you sure ?')">Delete Subject </a>
    </div>
</div>

<?php include("../includes/layout/footer.php"); ?>
