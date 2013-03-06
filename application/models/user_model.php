<?php
class User_Model extends Model
{

    public function __construct()
    {
        parent::__construct();

    }

    public function user_exist($user){
        try{
            $sql = 'SELECT * FROM app_user WHERE login = "'. $user .'"';
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetch();

        }catch(PDOException $e) {
            // Print PDOException message
            echo $e->getMessage();
            die('<br /> user_exist');
        }
        return $row;
    }
    /**
     * gets our user information.
     *
     * @param string|bool $id
     * @return array
     */
    public function user_info($id = false)
    {
        try{
            $sql = 'SELECT * FROM app_user';
            if ($id) {
                $sql .= " WHERE id = $id ";
            }
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        }catch(PDOException $e) {
            // Print PDOException message
            echo $e->getMessage();
            die();
        }
        return $result;
    }
    /**
     * Holds a list of clients sorted by our sales reps.
     *
     * @param bool $id
     * @return array
     */
    public function clients($id = false)
    {
        try{
            $sql = 'SELECT * FROM client';
            if ($id) {
                $sql .= " WHERE app_user_id = '$id' ";
            }
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        }catch(PDOException $e) {
            // Print PDOException message
            echo $e->getMessage();
            die();
        }
        return $result;
    }

    /**
     * Stores and returns our playlist for the jwplayer.
     *
     * @param $client_id
     * @return bool
     */
    public function playlist($client_id)
    {
        try{
            $sql = 'SELECT * FROM video';
            if ($client_id) {
                $sql .= " WHERE client_id = $client_id ";
            }
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        }catch(PDOException $e) {
            // Print PDOException message
            echo $e->getMessage();
            die();
        }
        return $result;
    }
}