<?php
$str = "";

if ($_FILES["file"]["size"] == 0)
	;
else if ($_FILES["file"]["type"] != "application/octet-stream" || !preg_match('/.db/i',$_FILES["file"]["name"]))
	$str = "Invalid format";

else if ($_FILES["file"]["size"] > 2000000)
	$str = "Oversize file";
else
  {
  if ($_FILES["file"]["error"] > 0)
    {
    $str = "Return Code: " . $_FILES["file"]["error"] . "<br />";
	}
  else
    {
    $str .= "Upload: " . $_FILES["file"]["name"] . "<br />";
    $str .= "Type: " . $_FILES["file"]["type"] . "<br />";
    $str .= "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    $str .= "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      $str .= $_FILES["file"]["name"] . " already exists in upload directory. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $_FILES["file"]["name"]);
      $str .= "Stored in: " . "upload/" . $_FILES["file"]["name"];
      }
    }
  }


echo $str;

?> 
