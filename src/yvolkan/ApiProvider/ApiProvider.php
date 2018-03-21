<?php

namespace YVolkan\ApiProvider;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Config\Repository as Config;
use YVolkan\ApiProvider\Traits\UserTrait;

class ApiProvider
{
    use UserTrait;

    /**
     * Client service
     *
     * @var Model
     */
    public $client;

    /**
     * Config.php values
     *
     * @var array
     */
    public $config;


    /**
     * Headers
     *
     * @var array
     */
    public $headers = [];

    /**
     * Authenticate token
     *
     * @var string
     */
    private $token;

    /**
     * Return message
     *
     * @var string
     */
    public $returnMsg;

    /**
     * Return status
     *
     * @var boolean
     */
    public $status;

    public function __construct($config = null)
    {
		if ($config instanceof Config) {
            if ($config->has('apiProvider::config')) {
                $this->config = $config->get('apiProvider::config');
            } elseif ($config->get('apiProvider')) {
                $this->config = $config->get('apiProvider');
            }
        } elseif ($config) {
            $this->config = $config;
        }

        if (!$this->config) {
			throw new Exception('No config found');
        }

        $this->client = new Client([
            'http_errors' => false,
            'verify'      => false,
        ]);
    }

    /**
     * Set Headers
     *
     * @param array $headers
     * @return void
     */
    public function setHeaders($headers = [])
    {
        $this->header = $headers;
        return $this;
    }

    /**
     * Query function
     *
     * @param string $name
     * @param string $requestMethod [GET|POST|PUT|DELETE]
     * @param array $parameters
     * @return Response
     */
    public function query($name, $requestMethod = 'GET', $parameters = [], $headers = [])
    {
        $url = $this->config['API_URL'].'/'.$this->config['API_VERSION'].'/'.$name;

        $headers = array_merge($this->header, $headers);

        $this->response = $this->client->request($requestMethod, $url, array_merge(
            ['json' => $parameters],
            ['headers' => $headers]
        ));

        if ($this->getStatusCode() && ($this->getStatusCode() < 200 || $this->getStatusCode() > 206)) {
            $this->setStatus(false);
        } else {
            $this->setStatus(true);
        }

        return $this->getResponse();
    }

    /**
     * GET method function
     *
     * @param string $name
     * @param array $parameters
     * @return void
     */
    public function get($name, $parameters = [], $headers = [])
    {
        return $this->query($name, 'GET', $parameters, $headers);
    }

    /**
     * POST method function
     *
     * @param string $name
     * @param array $parameters
     * @return void
     */
    public function post($name, $parameters = [], $headers = [])
    {
        return $this->query($name, 'POST', $parameters, $headers);
    }

    /**
     * DELETE method function
     *
     * @param string $name
     * @param array $parameters
     * @return void
     */
    public function delete($name, $parameters = [])
    {
        return $this->query($name, 'DELETE', $parameters);
    }

    /**
     * PUT method function
     *
     * @param string $name
     * @param array $parameters
     * @return void
     */
    public function put($name, $parameters = [])
    {
        return $this->query($name, 'PUT', $parameters);
    }

    /**
     * Set authenticate token
     *
     * @param string $token
     * @return void
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * Get authenticate token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Get response status code
     *
     * @return integer
     */
    public function getStatusCode()
    {
        return $this->response->getStatusCode();
    }

    /**
     * Get response body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->response->getBody();
    }

    /**
     * Get response body
     *
     * @return void
     */
    public function getResponse()
    {
        return json_decode($this->response->getBody());
    }

    /**
     * Set status response
     *
     * @param boolean $status
     * @return void
     */
    private function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }
}