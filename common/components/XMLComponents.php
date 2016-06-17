<?php
namespace common\components;

use yii\helpers\VarDumper;
use yii\web\ResponseFormatterInterface;

class XMLComponents implements ResponseFormatterInterface
{
    public function format($response)
    {
        $response->getHeaders()->set('Content-Type', 'text/xml; charset=UTF-8');
        if ($response->data !== null) {
            $response->content = '<checkOrderResponse ';
            foreach($response->data as $key => $value){
                $response->content .= $key.'="'.$value.'" ';
            }
            $response->content .= '/>';
        }
    }
}