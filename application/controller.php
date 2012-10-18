<?php
/**
 * Main controller for the MVC app
 *
 * @author Samuel Hilson
 */
class Controller
{

    public $load;
    public $model;
    public $url_data;
    public $data;
    // configure which methods require a password.
    // client method is unprotected so that clients can view commercials with a link.
    public $restricted = array('index', 'rep');

    /**
     * @param string $method specifies the method to be called within the controller
     * @param null $url_data extra segments of the url that contain useful info.
     * @param string $theme the theme that will be used to display pages.
     */
    function __construct($method, $url_data = null, $theme)
    {
        // store extra url information for our methods.
        $this->url_data = $url_data;
        $this->load = New Load($theme);
        $this->model = New Model();
        // add default stylesheet
        $this->load->css('style.css');
        // setup our session
        if (empty($_SESSION['login']))
        {
            $_SESSION['login'] = false;
        }
        // method routing 
        if (method_exists($this, $method))
        {
            // lets see if this requires a login
            if (in_array($method, $this->restricted))
            {
                $this->login($method);
            }
            else
            {
                $this->$method();
            }
        }
        else
        {
            // we didn't find a matching method. throw out that swanky 404.
            $this->load->view('404');
        }
    }

    /**
     * login method help validate credentials
     *
     * @param $method page we are trying to login to.
     */
    function login($method)
    {
        // see if we are already logged in.
        if ($_SESSION['login'] == true)
        {
            $this->$method($_SESSION['rep']);
        }
        else
        {
            // check credentials if logging in or display the login form.
            $data['title'] = 'Login Form';
            $this->load->css('login.css');
            if ($_POST)
            {
                if ($_POST['passwd'] == '' || $_POST['user'] == '')
                {
                    // throw an error if login form is blank.
                    $data['error'] = 'Do not leave fields blank.';
                    $data['method'] = $method;
                    $this->load->build('login', $data);
                }
                else
                {
                    // we got credentials lets validate them.
                    $user = strtolower($_POST['user']);
                    $passwd = sha1($_POST['passwd']);
                    $user_exist = $this->model->user_info($user);
                    if ($user_exist && $passwd == $user_exist['passwd'])
                    {
                        $_SESSION['login'] = true;
                        $_SESSION['rep'] = $user;
                        // yeah we are all good lets check our group and send them on the way.
                        if ($user_exist['group'] == 'admin')
                        {
                            header('Location: ' . BASE_URI  );
                        }
                        else
                        {
                            header('Location: ' . BASE_URI . '/rep/' . $user );
                        }

                    }
                    else
                    {
                        // login not good throw error.
                        $data['error'] = 'Username or password not recognized.';
                        $data['method'] = $method;
                        $this->load->build('login', $data);
                    }
                }
            }
            else
            {
                $data['method'] = $method;
                $this->load->build('login', $data);
            }
        }
    }

    /**
     * logout kill the session and send us back to our index method.
      */
    function logout()
    {
        session_destroy();
        header('Location: ' . BASE_URI . '/index');
    }

    /**
     * display list of reps and commercials. Admins are sent here on login.
     */
    function index()
    {
        $data['title'] = 'Wildcat Football Commercials';
        $data['reps'] = $this->model->user_info();
        $data['clients'] = $this->model->clients();
        $this->load->build('index', $data);
    }

    /**
     * show list of clients for a sales rep.
     * @param sting|bool $rep sales rep that logged in.
     */
    function rep($rep = false)
    {
        if ($rep)
        {
            $rep = $this->_segment(1);
        }
        $data['title'] = 'Wildcat Football Commercials';
        $data['reps'][$rep] = $this->model->user_info($rep);
        $data['clients'] = $this->model->clients();
        $this->load->build('index', $data);
    }

    /**
     *  client pages will show the jw player and a playlist of videos for that client.
     *  this link can be sent to clients for preview with out any need for logging in.
     */
    function client()
    {
        $data['title'] = 'Client Preview';
        $data['client'] = $this->_segment(1);
        $this->load->js('<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>');
        $this->load->js('<script type="text/javascript">
                            var CLIENT = "'. $data['client'] .'";
                            var BASE_URI = "'. BASE_URI .'";
                        </script>');
        $this->load->js('player.js');

        $this->load->build('player', $data);
    }

    /**
     *  builds our playlist for the client page. called by javascript in the client view.
     */
    function playlist()
    {
        $data['client'] = $this->_segment(1);
        $data['videos'] = $this->model->playlist($data['client']);
        if ($data['videos'])
        {
            $this->load->view('playlist', $data);
        }
    }

    /**
     *
     * _segment will get data from the urls querystring by the segment number
     * for example a url of index.php/home/extra/stuff home is the method. So to get the 
     * segment after home you would call $this->_segment(1); and to get the second 
     * segment after home you would call $this->_segment(2); and so on and so forth. 
     * Basically it makes it so that I don't have to use $this->_segment(0);
     */
    function _segment($x)
    {

        if ($x > 0)
        {
            $x--;
            $count = count($this->url_data);
            if ($x < $count)
            {
                return $this->url_data[$x];
            }
            else
            {
                return null;
            }
        }
        else
        {
            return null;
        }
    }

}