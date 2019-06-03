<div class="container_12">
<?php
foreach ($users as $row) {
    echo '<div class="clearfix"><h2 class="grid_5"><a href="' . Config::read('site') . 'rep/' .$row->id. '">' .$row->name . '</a></h2>';

         echo '<div class="grid_7 client_list"><ul><li><h3>Client List</h3></li>';
    foreach ($clients as $client) {
        if ($client->app_user_id == $row->id) {
                 echo '<li><a href="' . Config::read('site') . 'client/' .$client->id. '">' .$client->name. '</a></li>';
        }
    }
         echo '</ul></div>';
       echo '</div>';
}
?>

<hr />
<div class="grid_12"><a href="<?php echo Config::read('site'); ?>logout">Logout</a></div>
</div>
