<?php
namespace common\models\main;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    public $material;

    public function rules()
    {
        return [
            [['imageFile', 'material'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, JPG, JPEG, PNG'],
        ];
    }

    public function upload($type)
    {
        if ($this->validate()) {
            if(!@mkdir(Yii::$app->params['typeImage']['config']['src'] . Yii::$app->params['typeImage']['system'][$type]) && !is_dir(Yii::$app->params['typeImage']['config']['src'] . Yii::$app->params['typeImage']['system'][$type])){
                return false;
            }
            $this->imageFile->saveAs(Yii::$app->params['typeImage']['config']['src'] . Yii::$app->params['typeImage']['system'][$type] . '/' . Yii::$app->params['typeImage']['config']['prefixName'] . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return [
                'src' => Yii::$app->params['typeImage']['config']['url'] . Yii::$app->params['typeImage']['system'][$type] . '/' . Yii::$app->params['typeImage']['config']['prefixName'] . $this->imageFile->baseName . '.' . $this->imageFile->extension,
                'extension' => $this->imageFile->extension,
                'name'      => Yii::$app->params['typeImage']['config']['prefixName'] . $this->imageFile->baseName
            ];
        } else {
            return false;
        }
    }

}