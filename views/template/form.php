<?php foreach($errors as $error):?>

	<?php echo "<li>".$errors_msg[$error];?>

<?php endforeach;?>

<?php
	if(isset($_POST))
		$data = $_POST;
	elseif(isset($_GET)){
		$data = $_GET;
	}
?>
<form action="<?php echo $form["options"]["action"]?>" method="<?php echo $form["options"]["method"]?>">

	<?php foreach ($form["struct"] as $name => $option) :?>

		<?php if($option["type"] == "text"|| $option["type"]=="password"):?>
			<label for="<?php echo $name ?>"><?php echo $option["label"] ;?></label>
			<input name="<?php echo $name ?>" 
					type="<?php echo $option["type"] ;?>"
					id="<?php echo $option["id"] ;?>"
					placeholder="<?php echo $option["placeholder"] ;?>"
					<?php echo ($option["required"])?"required='required'":""?>
					value= "<?php echo (isset($data[$name]) && $option["type"]!="password")?$data[$name]:""?>"
					> 
		<?php elseif($option["type"]=="textarea"):?>
			<label for="<?php echo $name ?>"><?php echo $option["label"] ;?></label>
			<textarea name="<?php echo $name ?>"
						id="<?php echo $option["id"] ;?>"
						placeholder="<?php echo $option["placeholder"] ;?>" 
						<?php echo ($option["required"])?"required='required'":""?>><?php echo (isset($data[$name]))?$data[$name]:""?></textarea>

		<?php endif;?>

		<br>

	<?php endforeach;?>


	<input type="submit" value="<?php echo $form["options"]["submit"]?>">

</form>