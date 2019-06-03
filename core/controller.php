<?php
/**
 * Main controller for the MVC app
 *
 * @author Samuel Hilson
 */
class Controller
{

    public $url_data;
    public $data;
    private static $instance;
    // configure which methods require a password.
    // client method is unprotected so that clients can view commercials with a link.
    public $restricted = array('index', 'rep');


    function __construct()
    {
        self::$instance =& $this;
        // ====== borrowed this from codeigniter ====== //
        $uri = $_SERVER['REQUEST_URI'];
        if (strpos($uri, $_SERVER['SCRIPT_NAME']) === 0) {
            $uri = substr($uri, strlen($_SERVER['SCRIPT_NAME']));
        } elseif (strpos($uri, dirname($_SERVER['SCRIPT_NAME'])) === 0) {
            $uri = substr($uri, strlen(dirname($_SERVER['SCRIPT_NAME'])));
        }
        // Do some final cleaning of the URI and return it
        $uri = str_replace(array('//', '../'), '/', trim($uri, '/'));
        // ====== borrowed this from codeigniter ====== //

        // set our route and send the additional url as data array
        $x = explode('/', $uri, 2);
        $method = (empty($x[0]) ? 'index' : $x[0] );
        $data = (isset($x[1]) ? explode('/', $x[1]) : null);

        // store extra url information for our methods.
        $this->url_data = $data;
        $this->load = new Load();
        // add default stylesheet
        $this->load->css('style.css');
        // setup our session
        if (empty($_SESSION['login'])) {
            $_SESSION['login'] = false;
        }
        // method routing
        if (method_exists($this, $method)) {
            // lets see if this requires a login
            if (in_array($method, $this->restricted)) {
                $this->login($method);
            } else {
                $this->$method();
            }
        } else {
            // we didn't find a matching method. throw out that swanky 404.
           // $this->load->view('404');
        }
    }
    public static function &get_instance()
    {
        return self::$instance;
    }
    /**
     * login method help validate credentials
     *
     * @param string $method page we are trying to login to.
     */
    function login($method)
    {
        $this->load->model('user_model');
        // see if we are already logged in.
        if ($_SESSION['login'] == true) {
            $this->$method($_SESSION['user_id']);
        } else {
            // check credentials if logging in or display the login form.
            $data['title'] = 'Login Form';
            $this->load->css('login.css');
            if ($_POST) {
                if ($_POST['passwd'] == '' || $_POST['user'] == '') {
                    // throw an error if login form is blank.
                    $data['error'] = 'Do not leave fields blank.';
                    $data['method'] = $method;
                    $this->load->build('login', $data);
                } else {
                    // we got credentials lets validate them.
                    $user = strtolower($_POST['user']);
                    $passwd = sha1($_POST['passwd']);
                    $user_exist = $this->user_model->user_exist($user);
                    if ($user_exist && $passwd == $user_exist['password']) {
                        $_SESSION['login'] = true;
                        $_SESSION['user_id'] = $user_exist['id'];
                        // yeah we are all good lets check our group and send them on the way.
                        if ($user_exist['group'] == 'admin') {
                            header('Location: ' . Config::read('site'));
                        } else {
                            header('Location: ' . Config::read('site') . 'rep/' . $user_exist['id']);
                        }
                    } else {
                        // login not good throw error.
                        $data['error'] = 'Username or password not recognized.';
                        $data['method'] = $method;
                        $this->load->build('login', $data);
                    }
                }
            } else {
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
        header('Location: ' . Config::read('site') . 'index');
    }



    /**
     *
     * _segment will get data from the urls query string by the segment number
     * for example a url of index.php/home/extra/stuff home is the method. So to get the
     * segment after home you would call $this->_segment(1); and to get the second
     * segment after home you would call $this->_segment(2); and so on and so forth.
     * Basically it makes it so that I don't have to use $this->_segment(0);
     */
    function _segment($x)
    {

        if ($x > 0) {
            $x--;
            $count = count($this->url_data);
            if ($x < $count) {
                return $this->url_data[$x];
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
}
