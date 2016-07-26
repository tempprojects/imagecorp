<?php
namespace common\components;

use YandexMoney\API;
use yii\base\Component;
use yii\base\InvalidConfigException;

/**
 * Class YMoneyComponent
 * @package app\components
 */
class YMoneyComponent extends Component{

    /**
     * @var
     * int */
    public $client_id;
    /**
     * @var
     * string */
    public $response_type;
    /**
     * @var  string
     */
    public $redirect_uri;
    /**
     * @var null|string
     */
    public $client_secret = null;
    /**
     * @var  \YandexMoney\API
     * */
    private $api = null;
    /**
     * @var array
     */
    public $scope = array();
    /**
     * @var string
     */
    public $resultScope = '';

    /**
     * @var array
     */
    public $adsPay = [];
    /**
     * @var array
     */
    public $franchisePay = [];

    /**
     * @throws InvalidConfigException
     * @var $setToken boolean
     */
    public function init()
    {
        if (!$this->client_id) {
            throw new InvalidConfigException("Client_id can't be empty!");
        }
        if (!$this->response_type) {
            throw new InvalidConfigException("response_type can't be empty!");
        }
        if (!$this->redirect_uri) {
            throw new InvalidConfigException("Redirect_uri can't be empty!");
        }
        if (!$this->scope) {
            throw new InvalidConfigException("Redirect_uri can't be empty!");
        }
    }


    /**
     *      'scope' => [
     *          'account-info' => true,
     *           'operation-history' => true,
     *           'operation-details' => true,
     *           'payment' => [
     *               'to-account' => 'phone, email, schet',
     *               'limit' => '7,350'
     *           ],
     *           'payment-shop' => [
     *               'to-pattern' => 'pattern_id',
     *               'limit' => ',350'
     *           ],
     *           'payment-p2p' => [],
     *           'money-source' => [
     *               'wallet' => true,
     *               'card' => true
     *           ]
     *       ]
     *
     * @var $data array
     *
     */
    function setScope($data){
        $n = 0;
        foreach ($this->scope as $key => $value) {
            if(is_array($value)){
                $this->resultScope .= $key;
                foreach($value as $keySettings => $valueSettings){
                    if($key != 'money-source'){
                        if($data && $keySettings == 'limit'){
                            if($data['sum'] == 0){
                                $data['sum'] = '';
                            }
                            if($data['day'] == 0){
                                $data['day'] = '';
                            }
                            $this->resultScope .= '.'.$keySettings.'('.$data['sum'].','.$data['day'].')';
                        }
                        else{
                            $this->resultScope .= '.'.$keySettings.'("'.$valueSettings.'")';
                        }

                    }else{
                        if(!$n){
                            $this->resultScope .= '(';
                            $k = 0;
                            foreach($value as $keySource => $valueSource){
                                if($valueSource){
                                    if($k){
                                        $this->resultScope .= ', ';
                                    }
                                    $this->resultScope .= '\"'.$keySource.'\"';
                                }
                                $k++;
                            }
                            $this->resultScope .= ')';
                            $n++;
                        }
                    }
                }
                $this->resultScope .= ' ';
            }
            else{
                if($value){
                    $this->resultScope .= $key.' ';
                }
            }
        }
    }

    public function setToken($sum, $day){
        $this->setScope(['sum' => $sum, 'day' => $day]);
        $access_token = API::buildObtainTokenUrl($this->client_id, $this->redirect_uri, explode(' ', $this->resultScope));
        return $access_token;
    }

    public function getToken(){
        $code=$_GET['code'];
        $access_token_response = API::getAccessToken($this->client_id, $code, $this->redirect_uri, $this->client_secret);
        return $access_token_response;
    }



    /**
     * @return \YandexMoney\API
     */
    public function getYMoney($token)
    {
        $this->api = new API($token);
        return $this->api;
    }


}