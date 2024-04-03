<?php
namespace app\components;

use sizeg\jwt\JwtValidationData;

class MyJwtValidationData extends JwtValidationData
{
/**
* @inheritdoc
*/
public function init()
{
    $this->validationData->setIssuer('http://localhost');
    $this->validationData->setAudience('http://localhost');
$this->validationData->setId('4f1g23a12aa');
parent::init();
}
}
