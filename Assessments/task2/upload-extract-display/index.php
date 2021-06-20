
<?php
    $msg = "";

    if (isset($_POST['submit'])) {
        $fileName = $_FILES['uploadFile']['name'];
        $fileNameArr = explode('.', $fileName);

        if ($fileNameArr[count($fileNameArr)-1] == 'zip') {
            $fineName = $fileNameArr[0];
            $zip = new ZipArchive();

            if ($zip -> open($_FILES['uploadFile']['tmp_name']) === TRUE) {
                $path = "upload/$fineName/";
                $zip -> extractTo($path);
                $zip -> close();
                $files = scandir($path);
                
                foreach ($files as $file) {
                    $src = $path."$file";
                    if (strlen($file) > 4) {
                        $msg .= "<div class='col-sm'><img style='width:100%;' src='$src'></div>";
                    }
                }
            } else {
                $msg = 'Error';
            }
            
        } else {
            $msg = 'Please select zip file';
        }
        
    }
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Engineering Internship Assessment</title>
  <meta name="description" content="The HTML5 Herald" />
  <meta name="author" content="Digi-X Internship Committee" />

  <link rel="stylesheet" href="style.css?v=1.0" />
  <link rel="stylesheet" href="custom.css?v=1.0" />

</head>

<body>

    <div class="top-wrapper">
        <img src="https://assets.website-files.com/5cd4f29af95bc7d8af794e0e/5cfe060171000aa66754447a_n-digi-x-logo-white-yellow-standard.svg" alt="digi-x logo" height="70" />
        <h1>Engineering Internship Assessment</h1>
    </div>

    <div class="instruction-wrapper">
        <h2>What you need to do?</h2>
        <h3 style="margin-top:31px;">Using this HTML template, create a page that can:</h3>
        <ol>
            <li><b class="yellow">Upload</b> a zip file - containing 5 images (Cats, or Dogs, or even Pokemons)</li>
            <li>after uploading, <b class="yellow">Extract</b> the zip to get the images </li>
            <li><b class="yellow">Display</b> the images on this page</li>
        </ol>

        <h2 style="margin-top:51px;">The rules?</h2>
        <ol>
            <li>May use <b class="yellow">any programming language/script</b>. The simplest the better *wink*</li>
            <li><b class="yellow">Best if this project could be hosted</b></li>
            <li><b class="yellow">If you are not hosting</b>, please provide a video as proof (GDrive video link is ok)</li>
            <li><b class="yellow">Submit your code</b> by pushing to your own github account, and share the link with us</li>
        </ol>
    </div>

    <div class="zip-upload">
        <h3>Upload your zip file here</h3>
        <form method="post" class="zip-extract" enctype="multipart/form-data">
            <input type="file" name="uploadFile" id="zip" style="color:white;">
            <input type="submit" value="Upload" name="submit">
        </form>
    </div>

    <!-- DO NO REMOVE CODE STARTING HERE -->
    <div class="display-wrapper">
        <h2 style="margin-top:51px;">My images</h2>
        <div class="append-images-here container">
            <p>No image found. Your extracted images should be here.</p>
            <!-- THE IMAGES SHOULD BE DISPLAYED INSIDE HERE -->
            <div class="row">
                <?php echo $msg; ?>
            </div>
        </div>
    </div>
    <!-- DO NO REMOVE CODE UNTIL HERE -->

</body>
</html>