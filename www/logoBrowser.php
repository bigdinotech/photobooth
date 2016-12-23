<?php
$selectedImage = (isset($_POST['selectedImage'])) ? trim($_POST['selectedImage']) : "";
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
<meta charset="UTF-8" />
<title>Logo Browser</title>
		<link type="text/css" rel="stylesheet" href="photobrowser.css" />
		<link type="text/css" rel="stylesheet" href="global.css" />
		<script src="jquery-1.11.3.js"></script>
		<script type="text/javascript" src="cookies.js"></script>
<meta name="robots" content="noindex,nofollow" />
</head>
<body>
<strong>Logo Browser</strong>
<br />
<table>
<tr>
	<td>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<select name="selectedImage" id="selectedImage">
		<option value="">- Select a logo - </option>
		<?php 
		$files = scandir('./images/logos'); 
		 
		$c1 = count($files);
		$c2 = 0;
		 
		for($i=0; $i<$c1; $i++)
		{
		  if(strlen($files[$i]) > 3)
		  {
			$extension = strtolower(substr($files[$i], -4));
			if($extension == ".jpg")
			{
			  echo "<option value=\"".trim($files[$i])."\"";
			  if($selectedImage == $files[$i]) echo " selected=\"selected\"";
			  echo ">".$files[$i]."</option>\n";
			  $c2++;
			}
		  }
		}
		 
		?>
		</select>

		<input type="submit" value="View" style="height:50px; width:100px"/>
		</form>
	</td>
	<td id='buttontd'>
		<div class="assemblebutton">
			ASSEMBLE
		</div>
	</td>
	</tr>
</table>
<br />
<br />
<table class="photogrid">
			<tbody>
				<tr>
					<td id ='iframeContainer0'><img src="image0.jpg" style= "width: 100%" /></td>
					<td id ='iframeContainer1'><img src="image1.jpg" style= "width: 100%" /></td>
				</tr>
				<tr>
					<td id ='iframeContainer2'><img src="image2.jpg" style= "width: 100%" /></td>
					<td id ='iframeContainer3'>
					<?php
						if(!empty($selectedImage))
						{
							$selectedImage = "./images/logos/" . $selectedImage;
						  ?>
						  <img src="<?php echo $selectedImage ?>" alt="" style= "width: 100%"/>
						  <?php
						}
						?>
					</td>
				</tr>
			</tbody>
		</table>

</body>
<?php
echo "
	<script>
	$('.assemblebutton').click(function() {
	$.get('assembleLogo.php?photofilename=montage.jpg&logofilename=". $selectedImage . "');
	$(location).attr('href', './email.html');
	});
	</script>
";
?>
</html>