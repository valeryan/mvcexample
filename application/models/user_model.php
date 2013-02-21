<?php
class User_Model extends Model
{

    public function __construct()
    {
        parent::__construct();

    }
    /**
     * Stores our user information.
     *
     * @param bool $rep
     * @return array|bool
     */
    public function user_info($rep = false)
    {
        $reps = array('admin' => array('name' =>'Samuel Hilson',
            'passwd' => '89e495e7941cf9e40e6980d14a16bf023ccd4c91',
            'group' => 'admin' ),
            'user' => array('name' => 'Super Sales Guy',
                'passwd' => '89e495e7941cf9e40e6980d14a16bf023ccd4c91',
                'group' => 'sales')
        );
        if ($rep)
        {
            if (array_key_exists($rep, $reps))
            {
                return $reps[$rep];
            }
            else
            {
                return false;
            }
        }
        else
        {
            return $reps;
        }
    }
    /**
     * Holds a list of clients sorted by our sales reps.
     *
     * @param bool $rep
     * @return array
     */
    public function clients($rep = false)
    {
        $clients = array(
            'user' => array(
                'kix' => 'KIX 103',
                'fak1' => 'Fake Entry',
                'fak2' => 'Sample Text',
                'fak3' => 'Test Data'
            ),
            'admin' => array(
                'kix' => 'KIX 103',
                'fak1' => 'Fake Entry',
                'fak2' => 'Sample Text',
                'fak3' => 'Test Data'
            )
        );
        if ($rep)
        {
            return $clients[$rep];
        }
        else
        {
            return $clients;
        }
    }

    /**
     * Stores and returns our playlist for the jwplayer.
     *
     * @param $client
     * @return bool
     */
    public function playlist($client)
    {
        // '' => array(array('title' => '', 'description' => '', 'video' => '')),
        $videos = array(
            'kix' => array(array('title' => 'KIX 103', 'description' => 'Kix Dirt Video', 'video' => 'KIX103.flv'),
                array('title' => 'KIX 103', 'description' => 'Kix Dirt Video', 'video' => 'KIX103.flv')),
            'fak1' => array(array('title' => 'KIX 103', 'description' => 'Kix Dirt Video', 'video' => 'KIX103.flv'),
                array('title' => 'KIX 103', 'description' => 'Kix Dirt Video', 'video' => 'KIX103.flv')),
            'fak2' => array(array('title' => 'KIX 103', 'description' => 'Kix Dirt Video', 'video' => 'KIX103.flv'),
                array('title' => 'KIX 103', 'description' => 'Kix Dirt Video', 'video' => 'KIX103.flv')),
            'fak3' => array(array('title' => 'KIX 103', 'description' => 'Kix Dirt Video', 'video' => 'KIX103.flv'),
                array('title' => 'KIX 103', 'description' => 'Kix Dirt Video', 'video' => 'KIX103.flv'))
        );
        if ($client == '')
        {
            return false;
        }
        return $videos[$client];
    }
}