<?php
/**
 * Created by IntelliJ IDEA.
 * User: sandro
 * Date: 29.04.16
 * Time: 17:36
 */

$this->title = '';

$this->params['breadcrumbs'][] = $this->title;

$this->beginBlock('content-header');
echo $this->title;
$this->endBlock();

?>