<?php
/**
 * The load class is used by the controller to process the appropriate view.
 *
 * @author Samuel Hilson
 */
class Load 
{
	public $css;
	public $js;
	public $theme;

    /**
     * The constructor
     *
     * @access public
     * @return \Load
     * @param string $theme the theme used by the view.
     */
	function __construct($theme) {
		$this->theme = $theme;
	}

    /**
     * This function can add css to the template. It takes multiple inputs and determines the best action to add css.
     *
     * @param array|string $data array of stylesheets to be added to the view
     * @return void
     */
    function css( $data)
	{
        if (is_array($data))
        {
            foreach($data as $css)
            {
                if ($this->_check_type($css, 'css'))
                {
                    $this->css .= $css;
                }
                else
                {
                    $this->css .= '<link href="'. BASE_URI .'/assets/themes/'. $this->theme .'/css/' .$css. '" rel="stylesheet" /> ';
                }
            }
        }
        else
        {
            if ($this->_check_type($data, 'css'))
            {
                $this->css .= $data;
            }
            else
            {
                $this->css .= '<link href="'. BASE_URI .'/assets/themes/'. $this->theme .'/css/' .$data. '" rel="stylesheet" /> ';
            }

        }
	}
    /**
     * This function can add css to the template. It takes multiple inputs and determines the best action to add js
     *
     * @param array|string $data array of scripts to be added to the view
     * @return void
     */
    function js( $data )
    {
        if (is_array($data))
        {
            foreach($data as $js)
            {
                if ($this->_check_type($js, 'js'))
                {
                    $this->js .= $js;
                }
                else
                {
                    $this->js .= '<script type="text/javascript" src="'. BASE_URI .'/assets/js/' .$data. '" ></script> ';
                }
            }
        }
        else
        {
            if ($this->_check_type($data, 'js'))
            {
                $this->js .= $data;
            }
            else
            {
                $this->js .= '<script type="text/javascript" src="'. BASE_URI .'/assets/js/' .$data. '" ></script> ';
            }

        }
    }

    /**
     * helps to determine if the subject is a complete resource or a filename.
     *
     * @param string $data subject to be checked
     * @param string $func calling function
     * @return bool
     */
    function _check_type( $data, $func )
    {
       switch ($func)
       {
           case 'js':
                $pattern = '/<script/';
               break;

           case "css":
                $pattern = '/<link/';
               break;

       }
        if (preg_match($pattern, $data))
        {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * view is used for files that do not utilize the theme system.
     *
     * @param string $file the view to be retrieved.
     * @param array $data information being passed to the view.
     */
    function view( $file, $data = null)
    {
        // do a neat trick to convert array_keys to variables that are view can use
        if( is_array($data) )
        {
            extract($data);
        }
        include 'views/' . $file . '.php';
    }

    /**
     * build is used to display a view using a theme.
     *
     * @param string $file the view to be retrieved.
     * @param array $data information being passed to the view.
     */
    function build( $file, $data = null)
	{
        // do a neat trick to convert array_keys to variables that are view can use
		if( is_array($data) )
        {
            extract($data);
      	}
        // adds our theme header and footer
      	$header = file_get_contents('./assets/themes/'. $this->theme .'/header.php', FILE_USE_INCLUDE_PATH);
      	$footer = file_get_contents('./assets/themes/'. $this->theme .'/footer.php', FILE_USE_INCLUDE_PATH);
        // configure our values and then replace keys in our template with them.
      	$values = array('TITLE' => $title, 'CSS' => $this->css, 'JS' => $this->js);
		$header_output = preg_replace('/\{(\w+)\}/e',"\$values['\\1']",$header);
        // display the parsed header, view, and footer
      	echo $header_output;
      	include 'views/' . $file . '.php';
      	echo $footer;
	}
}
// end load.php