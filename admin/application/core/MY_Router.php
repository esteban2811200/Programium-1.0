<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MY_Router Class
 *
 * @author        Damien K.
 */
class MY_Router extends CI_Router {

    protected function _set_routing() {

        if (file_exists(APPPATH.'config/routes.php'))
        {
            include(APPPATH.'config/routes.php');
        }

        if (file_exists(APPPATH.'config/'.ENVIRONMENT.'/routes.php'))
        {
            include(APPPATH.'config/'.ENVIRONMENT.'/routes.php');
        }

        // Validate & get reserved routes
        if (isset($route) && is_array($route))
        {
            isset($route['default_controller']) && $this->default_controller = $route['default_controller'];
            isset($route['translate_uri_dashes']) && $this->translate_uri_dashes = $route['translate_uri_dashes'];
            unset($route['default_controller'], $route['translate_uri_dashes']);
            $this->routes = $route;
        }

        if ($this->enable_query_strings) {

            if ( ! isset($this->directory))
            {
                $route = isset($_GET['route']) ? trim($_GET['route'], " \t\n\r\0\x0B/") : '';

                if ($route !== '')
                {
                    $part = explode('/', $route);

                    if ( ! empty($part[1])) {

                        $this->uri->filter_uri($part[0]);
                        $this->set_directory($part[0]);
                        $this->set_class($part[0]);

                        // Testing only
                        if ( ! empty($part[1]))
                        {
                            $this->uri->filter_uri($part[1]);
                            $this->set_method($part[1]);
                        }

                        $this->uri->rsegments = array(
                            1 => $this->class,
                            2 => $this->method
                        );
                    }

                } else {

                    $this->_set_default_controller();
                }
            }

            // Routing rules don't apply to query strings and we don't need to detect
            // directories, so we're done here
            return;
        }

        // Is there anything to parse?
        if ($this->uri->uri_string !== '')
        {
            $this->_parse_routes();
        }
        else
        {
            $this->_set_default_controller();
        }
    }
}
