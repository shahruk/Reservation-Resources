<div class = "clearfix person_card">
	<div>
	<?php if(isset($user['User']['profile_picture'])){
			echo $this->Html->image($user['User']['profile_picture'],array('class'=>'profile_picture'));
	} else{
			echo $this->Html->image('anonymous.jpg',array('class'=>'profile_picture'));
	}
	
	?>
		
	</div>
	<div>
		<h1><?php echo $user['User']['first_name']." ".$user['User']['last_name']; ?></h1>
			<?php echo $user['User']['about_me']; ?>
		<div class = "row-fluid social_media">
			<div class = "span6">
				<div class = "clearfix">
					<?php echo $this->Html->image('icons/tick.png'); ?> <div>Phone Verified</div>
				</div>
				<div class = "clearfix">
					<?php echo $this->Html->image('icons/facebook-icon.png'); ?> <div>Facebook Verified</div>
				</div>
				<div class = "clearfix">
					<?php echo $this->Html->image('icons/thumbsup.png'); ?> <div>Positively Reviewed</div>
				</div>
			</div>
			<div class = "score_card span6">
				<div class = "score">
					99%
				</div> 
				Approval Rating
			</div>
		</div>
	</div>
	
</div>