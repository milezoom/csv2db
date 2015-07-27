<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Upload CSV to Database</title>
</head>
<body>
    <h2>Upload CSV to Database</h2>
    <span>dbname: <?php echo $dbname;?></span><br/>
    <span>tablename: <?php echo $tablename;?></span>
    <?php echo $error; ?>
    <?php
        echo form_open_multipart('Upload/do_upload');
    ?>
    <input type="file" name="userfile" size="20" />
    <br/><br/>
    <input type="submit" value="upload" />
    </form>
    For example csv format, click <a href="<?php echo site_url('Upload/download_example') ?>">here</a>.
</body>
</html>
