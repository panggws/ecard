<html>
<head>
<title>Create file</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php

$strFileName = "index.html";
$objFopen = fopen($strFileName, 'w');
$header = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>Father\'s Day</title>';
$header = "<link href='http://fonts.googleapis.com/css?family=Abel|Fjalla+One' rel='stylesheet' type='text/css'>";
fwrite($objFopen, $header);

$css = '<style type="text/css">';
// $css .= 'h1 { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 38px; color: #'.(string)$_POST['textColor'].' !important; margin: 0; padding: 0 0 0 15px; font-style: italic; }';
// $css .=  'h2 { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 20px; color: #'.(string)$_POST['textColor'].' !important; margin: 0 0 7px 0; }';
$css .= '#indexp { font-family: "Abel",sans-serif; font-size: 14px; line-height: 21px; color: #'.(string)$_POST['textColor'].'; margin: 0 0 12px 0; }';
$css .= '.footer p, .header p ,.footer p a { font-family: "Abel",sans-serif; font-size:11px; color:#'.(string)$_POST['textColor'].'; margin: 0;}';
// $css .= 'a{ font-family:Verdana, Arial, Helvetica, sans-serif;color:#'.(string)$_POST['textColor'].';}';
$css .='#download{ margin-right:10px;}';
$css .= '</style>';
$css .= '</head>';
fwrite($objFopen, $css);

$body = '<body style="margin:0; padding:0; background-color:#FFFFFF;">
<table width="500" height="auto" border="0" cellspacing="0" cellpadding="0" align="center" style="background-color:#FFFFFF;">
    <tr>
        <td valign="top" align="center">
            <table width="500" border="0" cellpadding="0" cellspacing="0" align="center" style="">
                <tr>
                    <td align="center" valign="top" style="padding-top:10px;">
                        <table class="top" width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td valign="top" height="50" class="header">
                                    <p align="center" id="indexp">Email not displaying correctly?
                                        <webversion style="color:#'.(string)$_POST['textColor'].'; text-decoration: none;">View it in your browser</webversion>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top">
						<img border="0" editable="true" width="592"src="images/ecard.png"/>
                    </td>
                </tr>
				<tr>
                    <td align="left" valign="top" class="footer" height="auto">
						<p align="center" id="indexp">
						<multiline label="Footer content">This mail was sent to <a href="mailto:[email]">[email]</a> from:<br>
						'.stripslashes($_POST['address']).' E-Mail: <a href="mailto:'.(string)$_POST['mail'].'">'.(string)$_POST['mail'].'</a><br>
						</multiline>
						</p>
						<p align="center" id="indexp">
						© <currentyear> '.urldecode($_POST['company']).'. All rights reserved. <unsubscribe>Unsubscribe</unsubscribe>
						</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<center>
<br/><br/>
<span id="download"><a href="index.html" target="_blank" class="btn btn-primary">View demo</a></span>
<span id="download"><a href="images.zip" target="_blank" class="btn btn-primary">Download zip file</a></span>
</center>
<br/><br/>
</body>';
fwrite($objFopen, $body);



  if ($_FILES["file"]["error"] > 0)
    {
   // echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    // echo "<center> Upload: " . $_FILES["file"]["name"] . "<br />";
    // echo "Type: " . $_FILES["file"]["type"] . "<br />";
    // echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    // echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    
     move_uploaded_file($_FILES["file"]["tmp_name"],
     "images/ecard.png");
	 
     //echo "Stored in: " . "images/ecard.png";
      
    }
  



// if($objFopen)
// {
// 	echo "File writed.";
// }
// else
// {
// 	echo "File can not write";
// }

fclose($objFopen);

/* creates a compressed zip file */
function create_zip($files = array(),$destination = '',$overwrite = true) {
	//if the zip file already exists and overwrite is false, return false
	if(file_exists($destination) && !$overwrite) { return false; }
	//vars
	$valid_files = array();
	//if files were passed in...
	if(is_array($files)) {
		//cycle through each file
		foreach($files as $file) {
			//make sure the file exists
			if(file_exists($file)) {
				$valid_files[] = $file;
			}
		}
	}
	//if we have good files...
	if(count($valid_files)) {
		//create the archive
		$zip = new ZipArchive();
		if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
			return false;
		}
		//add the files
		foreach($valid_files as $file) {
			$zip->addFile($file,$file);
		}
		//debug
		//echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
		
		//close the zip -- done!
		$zip->close();
		
		//check to make sure the file exists
		return file_exists($destination);
	}
	else
	{
		return false;
	}
}

$files_to_zip = array(
	'images/ecard.png');

//if true, good; if false, zip creation failed
$result = create_zip($files_to_zip,'images.zip');

//header("Location: script.html");
require 'script.html';
?>

<!-- <br/><br/>
<p><a href="index.html" target="_blank" class="btn btn-primary">Download file</a></p>
<p><a href="images.zip" target="_blank" class="btn btn-primary">Download zip file</a></p>
</center> -->
</body>
</html>