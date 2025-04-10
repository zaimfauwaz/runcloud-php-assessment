<?php

namespace Project;

class BasicPlan extends Plans
{
    protected $maxInstances = 1;
    public function getPlanType()
    {
        return "Basic Plan";
    }

    // Using get method

    public function getServerLimit(){
        return $this->maxInstances;
    }
}