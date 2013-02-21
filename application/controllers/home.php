<?php

class home extends Controller {
   public function __construct()
   {
       parent::__construct();
   }
    /**
     * display list of reps and commercials. Admins are sent here on login.
     */
    function index()
    {
        $this->load->model('user_model');
        $data['title'] = 'Wildcat Football Commercials';
        $data['users'] = $this->user_model->user_info();
        $data['clients'] = $this->user_model->clients();
        $this->load->build('index', $data);
    }

    /**
     * show list of clients for a sales rep.
     * @param string|bool $id sales rep that logged in.
     */
    function rep($id)
    {
        $this->load->model('user_model');
        if (!$id)
        {
            $id = $this->_segment(1);
        }
        $data['title'] = 'Wildcat Football Commercials';
        $data['users'] = $this->user_model->user_info($id);
        $data['clients'] = $this->user_model->clients();
        $this->load->build('index', $data);
    }

    /**
     *  client pages will show the jw player and a playlist of videos for that client.
     *  this link can be sent to clients for preview with out any need for logging in.
     */
    function client()
    {
        $data['title'] = 'Client Preview';
        $data['client_id'] = $this->_segment(1);
        $this->load->js('<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>');
        $this->load->js('<script type="text/javascript">
                            var CLIENT_ID = "'. $data['client_id'] .'";
                            var BASE_URI = "/'. Config::read('base_uri') .'";
                        </script>');
        $this->load->js('player.js');

        $this->load->build('player', $data);
    }

    /**
     *  builds our playlist for the client page. called by javascript in the client view.
     */
    function playlist()
    {
        $this->load->model('user_model');
        $data['client_id'] = $this->_segment(1);
        $data['videos'] = $this->user_model->playlist($data['client_id']);
        if ($data['videos'])
        {
            $this->load->view('playlist', $data);
        }
    }
}