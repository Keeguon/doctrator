<?php

$loader = require __DIR__ . "/../vendor/autoload.php";
$loader->add('Model', __DIR__);

// mondator
use Mandango\Mondator\Mondator;

$configClasses = array(
    'Model\Article' => array(
        'columns' => array(
            'id'       => array('id' => 'auto', 'type' => 'integer'),
            'title'    => array('type' => 'string', 'length' => 100),
            'slug'     => array('name' => 'titleSlug', 'type' => 'string', 'length' => 110, 'unique' => true),
            'content'  => 'text',
            'source'   => array('type' => 'string', 'length' => 255, 'nullable' => true),
            'isActive' => array('type' => 'boolean', 'default' => true),
            'score'    => array('type' => 'decimal', 'precision' => 2, 'scale' => 4),
            'date'     => 'date',
        ),
        'many_to_one' => array(
            'category' => array('class' => 'Model\Category', 'inversedBy' => 'articles'),
        ),
        'indexes' => array(
            'my_slug_index'  => array('columns' => array('titleSlug'), 'unique' => true),
            'isActive_date' => array('columns' => array('isActive', 'date')),
        ),
    ),
    'Model\Category' => array(
        'columns' => array(
            'id'   => array('id' => 'auto', 'type' => 'integer'),
            'name' => array('type' => 'string', 'length' => 100)
        ),
        'one_to_many' => array(
            'articles' => array('class' => 'Model\Article', 'mappedBy' => 'category'),
        ),
    ),
    'Model\Simple' => array(
        'columns' => array(
            'id'      => array('id' => 'auto', 'type' => 'integer'),
            'column'  => array('type' => 'string', 'length' => 255),
            'column2' => array('type' => 'string', 'length' => 255, 'nullable' => true),
        ),
    ),
    /*
     * One
     */
    'Model\Student' => array(
        'columns' => array(
            'id'   => array('id' => 'auto', 'type' => 'integer'),
            'name' => array('type' => 'string', 'length' => 255),
        ),
        'many_to_one' => array(
            'school' => array('class' => 'Model\School', 'inversedBy' => 'students'),
        ),
    ),
    'Model\School' => array(
        'columns' => array(
            'id'   => array('id' => 'auto', 'type' => 'integer'),
            'name' => array('type' => 'string', 'length' => 255),
        ),
        'one_to_many' => array(
            'students' => array('class' => 'Model\Student', 'mappedBy' => 'school'),
        ),
    ),
    /*
     * Many
     */
    'Model\Person' => array(
        'columns' => array(
            'id'   => array('id' => 'auto', 'type' => 'integer'),
            'name' => array('type' => 'string', 'length' => 255),
        ),
        'many_to_many' => array(
            'likings' => array('class' => 'Model\Liking', 'inversedBy' => 'persons'),
        ),
    ),
    'Model\Liking' => array(
        'columns' => array(
            'id'   => array('id' => 'auto', 'type' => 'integer'),
            'name' => array('type' => 'string', 'length' => 255),
        ),
        'many_to_many' => array(
            'persons' => array('class' => 'Model\Person', 'mappedBy' => 'likings'),
        ),
    ),
    /*
     * Specific
     */
    'Model\IdentifierStrategyIdentity' => array(
        'columns' => array(
            'id' => array('id' => array('strategy' => 'identity'), 'type' => 'integer'),
        ),
    ),
    'Model\IdentifierStrategyNone' => array(
        'columns' => array(
            'id' => array('id' => array('strategy' => 'none'), 'type' => 'integer'),
        ),
    ),
    /*
     * Behaviors
     */
    'Model\Hashable' => array(
        'columns' => array(
            'id'    => array('id' => 'auto', 'type' => 'integer'),
            'title' => 'string',
        ),
        'behaviors' => array(
            array('class' => 'Doctrator\Behavior\Hashable'),
        ),
    ),
    'Model\Ipable' => array(
        'columns' => array(
            'id'    => array('id' => 'auto', 'type' => 'integer'),
            'title' => 'string',
        ),
        'behaviors' => array(
            array('class' => 'Doctrator\Behavior\Ipable'),
        ),
    ),
    'Model\Sluggable' => array(
        'columns' => array(
            'id'    => array('id' => 'auto', 'type' => 'integer'),
            'title' => 'string',
        ),
        'behaviors' => array(
            array('class' => 'Doctrator\Behavior\Sluggable', 'options' => array('from_column' => 'title')),
        ),
    ),
    'Model\SluggableUpdate' => array(
        'columns' => array(
            'id'    => array('id' => 'auto', 'type' => 'integer'),
            'title' => 'string',
            'body'  => array('type' => 'text', 'nullable' => true),
        ),
        'behaviors' => array(
            array('class' => 'Doctrator\Behavior\Sluggable', 'options' => array('from_column' => 'title', 'update' => true)),
        ),
    ),
    'Model\Sortable' => array(
        'columns' => array(
            'id'    => array('id' => 'auto', 'type' => 'integer'),
            'title' => 'string',
        ),
        'behaviors' => array(
            array('class' => 'Doctrator\Behavior\Sortable'),
        ),
    ),
    'Model\Taggable' => array(
        'columns' => array(
            'id'    => array('id' => 'auto', 'type' => 'integer'),
            'title' => 'string',
        ),
        'behaviors' => array(
            array('class' => 'Doctrator\Behavior\Taggable'),
        ),
    ),
    'Model\Timestampable' => array(
        'columns' => array(
            'id'    => array('id' => 'auto', 'type' => 'integer'),
            'title' => 'string',
        ),
        'behaviors' => array(
            array('class' => 'Doctrator\Behavior\Timestampable'),
        ),
    ),
    'Model\Translatable' => array(
        'columns' => array(
            'id'       => array('id' => 'auto', 'type' => 'integer'),
            'title'    => array('type' => 'string', 'length' => 255),
            'body'     => array('type' => 'text'),
            'date'     => array('type' => 'datetime'),
            'isActive' => array('type' => 'boolean', 'default' => true),
        ),
        'behaviors' => array(
            array('class' => 'Doctrator\Behavior\Translatable', 'options' => array('columns' => array('title', 'body'))),
        ),
    ),
);

$mondator = new Mondator();
$mondator->setConfigClasses($configClasses);
$mondator->setExtensions(array(
    new Doctrator\Extension\Core(array(
        'default_output' => __DIR__.'/Model',
    )),
    new Doctrator\Extension\ActiveRecord(),
    new Doctrator\Extension\ArrayAccess(),
    new Doctrator\Extension\PropertyOverloading(),
    new Doctrator\Extension\Behaviors(),
));
$mondator->process();

/*
 * Not ActiveRecord
 */
$mondator = new Mondator();
$mondator->setConfigClasses($configClasses);
$mondator->setExtensions(array(
    new Doctrator\Extension\Core(array(
        'default_output' => __DIR__.'/ModelNotAR'
    )),
));
$mondator->process();
