<div class="container_12">
<?php
   foreach ($reps as $key => $value)
   {
   	echo '<div class="clearfix"><h2 class="grid_5"><a href="' . BASE_URI . '/rep/' .$key. '">' .$value['name']. '</a></h2>';
		if (array_key_exists($key, $clients))
		{
			echo '<div class="grid_7 client_list"><ul><li><h3>Client List</h3></li>';
			foreach ($clients[$key] as $slug => $title) 
			{
			echo '<li><a href="' . BASE_URI . '/client/' .$slug. '">' .$title. '</a></li>';
			}
			echo '</ul></div>';
		}
    echo '</div>';
   }
?>
<hr />
<div class="grid_12"><a href="<?php echo BASE_URI; ?>/logout">Logout</a></div>
</div>