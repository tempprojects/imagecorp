<?php
namespace common\components;

use yii\helpers\VarDumper;
use yii\web\ResponseFormatterInterface;

class XMLAvisoComponents implements ResponseFormatterInterface
{
    public function format($response)
    {
        $response->getHeaders()->set('Content-Type', 'text/xml; charset=UTF-8');
        if ($response->data !== null) {
            $response->content = '<?xml version="1.0" encoding="UTF-8"?>';
            $response->content = '<paymentAvisoResponse ';
            foreach($response->data as $key => $value){
                $response->content .= $key.'="'.$value.'" ';
            }
            $response->content .= '/>';
        }
    }
}