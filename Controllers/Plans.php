<?php

namespace Project;

abstract class Plans {

    // Protected Attributes
    protected $maxInstances;

    // List of Functions
    abstract public function getPlanType();
    abstract public function getServerLimit();
}

