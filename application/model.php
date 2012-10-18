<?php
/**
 * This Model would interface with PDO class and get data from database however
 * we will use arrays to fake a database so that the app can be ran from anywhere.
 * all actual data was removed and examples where inserted.
 */
class Model
{

    /**
     * Stores our user information.
     *
     * @param bool $rep
     * @return array|bool
     */
    public function user_info($rep = false)
    {
        $reps = array('sam' => array('name' =>'Samuel Hilson',
                                     'passwd' => 'dfccc06f14414bff5a59be7fc90abf4404b47fc8',
                                     'group' => 'admin' ),
                      'salesguy' => array('name' => 'Super Sales Guy',
                                          'passwd' => '59248c4dae276a021cb296d2ee0e6a0c962a8d7f',
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
            'salesguy' => array(
                'kix' => 'KIX 103',
                'fak1' => 'Fake Entry',
                'fak2' => 'Sample Text',
                'fak3' => 'Test Data'
            ),
            'sam' => array(
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
// end model.php