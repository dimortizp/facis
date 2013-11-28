<?php
/* @var $this SOCIOController */
/* @var $model SOCIO */

$this->breadcrumbs = array(
    'Socios' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'Lista de socios', 'url' => array('admin')),
    array('label' => 'Crear Socio', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#socio-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gestión de Socios</h1>

<p>
    Opciones de ordenamiento (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>)
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'socio-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'K_IDENTIFICACION',
        'N_NOMBRE',
        'N_APELLIDO',
        //I_ESTADO_CIVIL',
        //'N_OCUPACION',
        'O_TARJETA_PROFESIONAL',
        //'I_GENERO',
        //'O_DIRECCION_DOMICILIO',
        //'O_DIRECCION_TRABAJO',
        'O_CORREO_ELECTRONICO',
        'O_TELEFONO_DOMICILIO',
        'O_TELEFONO_TRABAJO',
        'O_TELEFONO_CELULAR',
        'F_INGRESO',
        //'F_RETIRO',
        //'O_CAUSAL_RETIRO',

        array(
            'class' => 'CButtonColumn',
            'template' => '{view}',
        ),
    ),
));
?>
