<?php
namespace Ziki\Http;
class Router
{
    protected $request;
    protected $pattern = '/^[0-9A-Za-z-_]+$/'; // ['int' => '/^[0-9]+$/', 'any' => '/^[0-9A-Za-z]+$/'];
    protected $httpMethods = ['get', 'post', 'put', 'patch', 'delete'];

    public function __construct()
    {
        $this->request = new Request;
    }
    function __call($name, $args)
    {
        $this->handle($name, $args);
    }
    static function __callStatic($name, $args) 
    {
        (new self)->handle($name, $args);
    }  
    private function handle($method, $args)
    {
        $method = strtolower($method);
        if (!in_array($method, $this->httpMethods)) {
            $this->invalidMethodHandler();
        }
        list($route, $callable) = $args;
        $formatRoute = $this->_format($route);
        $formatRequest = $this->_format($this->request->requestUri);
        $matches = $this->_match($formatRoute, $formatRequest);
        if (is_array($matches)) {
            $params = implode(',', $matches);
            echo call_user_func($callable, $this->request, $params );
            exit;
        };
    }  
    /**
	 * Match route and checks if any wild cards are supplied.
	 *
	 * This will return false if there is a mis-match anywhere in the route, 
	 * or it will return an array with the key => values being the user supplied variable names.
	 *
	 * If no variable names are supplied an empty array will be returned.
	 *
     * @param string $request The user-supplied route (with wild cards) to match against
     * 
	 * @param string $request The user-supplied route (with wild cards) to match against
	 *
	 * @return mixed
	 */
    private function _match($route,$request) {
        $params = [];
        $exp_request = explode('/', $request);
        $exp_route = explode('/', $route);
        // dd($exp_request, $request, $exp_route, $route);
        if (count($exp_request) == count($exp_route)) {
            foreach($exp_route as $key => $value) {
                // echo $value[0];
                // print "\n";
                if ($value == $exp_request[$key]) {
                    continue; // So far the routes are matching
                }
                elseif (!empty($value) && $value[0] == '{' && substr($value, -1) == '}') {
                    $exp = str_replace(array('{','}') , '', $value);
                    if (preg_match($this->pattern, $exp_request[$key])) {
                        if (isset($exp)) {
                            $params[$exp] = $exp_request[$key];
                        }
                        continue; // We have a matching pattern
                    }
                }
                return false; // There is a mis-match
            }
            return $params; // All segments match
        }
        return false; // Catch anything else
    }
    /**
     * Removes trailing forward slashes from the right of the path.
     * @param route (string)
     */
    private function _format($path)
    {
        $result = trim(strtok($path, '?'), '/\\');
        if ($result === '') {
            return '/';
        }
        return $result;
    }
    private function invalidMethodHandler()
    {
       return error("405 Method Not Allowed");
    }
    public function defaultRequestHandler()
    {
       return error("{$this->request->serverProtocol} 404 Route Not Found");
    }
}
