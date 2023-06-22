<?php

interface ModelsInterface{

    public function create();
    public function get($field, $value);
    public function getAll();
    public function update($field, $fieldvalue, $params);
    public function filter($filter_conditions);
    public function search($search);


}

?>