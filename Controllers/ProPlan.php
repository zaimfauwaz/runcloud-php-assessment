<?php

namespace Project;

class ProPlan extends Plans
{
    protected $maxInstances = 50;
    public function getPlanType()
    {
        return "Pro Plan";
    }

    // Using get method

    public function getServerLimit(){
        return $this->maxInstances;
    }
}