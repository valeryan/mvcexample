<?php
/**
 * This Model would interface with PDO class and get data from database however
 * we will use arrays to fake a database so that the app can be ran from anywhere.
 * all actual data was removed and examples where inserted.
 */
class Model
{

    public function __construct()
    {
        // Create (connect to) SQLite database in file
        $this->db = new PDO('sqlite:application/mvc.s3db');
        // Set errormode to exceptions
        $this->db->setAttribute(PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION);
    }
}
// end model.php