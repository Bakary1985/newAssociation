<?php
/**
 * Created by PhpStorm.
 * User: tresor
 * Date: 02/04/2019
 * Time: 10:29
 */

namespace AppBundle\Service;


class Api
{
    private $host;

    /**
     * Api constructor.
     * @param $host
     */
    public function __construct($host)
    {
        $this->host = $host;
    }

    public function getExhibitor(){
        $url = $this->getHost();
        $data = $this->getData($url);
        return  $data->exposants;
    }

    public function getActivities(){
        $url = $this->getHost();
        $data = $this->getData($url);
        return  $data->tableauActivites->activite;
    }

    public function getSpeaker(){
        $url = $this->getHost();
        return  $this->getData($url);
    }

    public function getSession(){
        $url = $this->getHost();
        return  $this->getData($url);

    }
    public function authentification(){
        return array(
            'Content-Type: application/xml',
            "access_token: ".$this->getPassword()
        );
    }

    public function getData($url){
        $content = file_get_contents($url);
        $xml = new \SimpleXMLElement($content);
        return $xml;

    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
}