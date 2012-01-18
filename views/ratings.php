<div class="ratingsReadout">
	<?if( $numberOfRatings > 0):?>
	<dl>
		<dt class="grid_2">Average Rating</dt><dd class="grid_1"><?=$averageRating;?></dd>
		<dt class="grid_2">Number of Ratings</dt><dd class="grid_1"><?=$numberOfRatings;?></dd>
	</dl>
	<?else:?>
	<p>Unrated</p>
	<?endif; ?>
</div>