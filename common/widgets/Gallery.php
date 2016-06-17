<?php
namespace common\widgets;

use Yii;
use yii\base\Widget;
use common\models\database\Gallery as ModelGallery;

class Gallery extends Widget
{

    public $type;
    public $idInput;
    public $img;

    public function init()
    {
        parent::init();

        if($this->type === null){
            $this->type = 1;
        }
        else{
            if(is_array($this->type)){
                $id = [];
                foreach ($this->type as $item) {
                    $id[] = Yii::$app->params['typeImage']['key'][$item];
                }
                $this->type = $id;
            }
            else{
                $this->type = Yii::$app->params['typeImage']['key'][$this->type];
            }

        }
        if($this->idInput === null){
            $this->idInput = 0;
        }
        if($this->idInput === null){
            $this->img = '';
        }
    }

    public function run() {
        $model = ModelGallery::find()->where(['type' => $this->type])->orderBy(['id' => SORT_DESC])->all();
        return $this->render('gallery',[
            'model'   => $model,
            'idInput' => $this->idInput,
            'img'     => $this->img,
        ]);
    }

}