<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <p>Page d'aide pour l'API</p>
    </div>

    <p>
	Pour faire une recherche bien précise => "urlApi/nom_de_la_table_au_pluriel/search?nom_dun_attribut=..."
    </p>
</div>
