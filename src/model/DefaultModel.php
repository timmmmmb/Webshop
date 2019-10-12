<?php

require_once 'src/lib/Model.php';

/**
 * Default model is invoked by home page.
 */
class DefaultModel extends Model 
{
    //Set table for DefaultController to get all products for home page.
    protected $tableName = 'products';
}