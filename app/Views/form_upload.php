<!DOCTYPE html>
<html>
<head>
  <title>Codeigniter 4 Image upload example</title>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
 
</head>
<body>
 <div class="container">
    <br>
     
    <?php if (session('msg')) : ?>
        <div class="alert alert-info alert-dismissible">
            <?= session('msg') ?>
            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
        </div>
    <?php endif ?>
 
    <div class="row">
      <div class="col-md-9">
        <form action="<?php echo base_url('public/index.php/form/store');?>" name="ajax_form" id="ajax_form" method="post" accept-charset="utf-8" enctype="multipart/form-data">
 
          <div class="form-group">
            <label for="formGroupExampleInput">Name</label>
            <input type="file" name="file" class="form-control" id="file">
          </div> 
 
          <div class="form-group">
           <button type="submit" id="send_form" class="btn btn-success">Submit</button>
          </div>
          
        </form>
      </div>
 
    </div>
    <div class="container row">
            <?php
                if ((isset($images)) && (is_array($images))) {
                    foreach ($images as $image){
echo <<<EOT
<div class="col-sm-6 col-md-3">
            <img src="$image" class="img-thumbnail"/>                
</div>
EOT;

                    }
                }
            ?>
    </div>  
</div>
</body>
</html>