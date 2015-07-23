<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upload CSV to Database</title>
</head>
<body>
    <h2>Upload CSV to Database</h2>
    <h3>Your file was successfully uploaded, and inserted to database.</h3>
    <p>
        <?php echo anchor('upload', 'Upload another file!'); ?>
    </p>
</body>
</html>
