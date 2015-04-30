
<?php

?>


<br /><br /><br /><br />
Upload database file:
<form action="<?php echo$_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <label for="file">Filename:</label>
        <input type="file" name="file" id="file" />
        <br />
        <input type="submit" name="submit" value="Upload" />
</form>

<?php
include 'uploadFile_samepage.php';
?>


<br />
<br />
Please enter your query:
<form action="<?php echo$_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
</form>

<?php
include 'onepage_query.php';
?>



