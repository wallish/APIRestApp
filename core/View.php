<?php

class View
{
    protected $variables = array();

    public function __construct()
    {
    }

    public function set($name, $value)
    {
        $this->variables[$name] = $value;
    }

    public function render($view, array $data = null)
    {
        //extract($this->variables);
        if ($data) {
            foreach ($data as $key => $value) {
                $this->variables[$key] = $value;
            }
        }

        if (file_exists('views/'.$view.'.php')) {
            include 'views/'.$view.'.php';
        } else {
            die('error view');
        }
    }

    public function path(array $path, array $info = null)
    {
        $url = "http://$_SERVER[HTTP_HOST]/api/".$path[0].'/'.$path[1].'/?';
        $foo = http_build_query($info);

        return $url.$foo;
    }
}
