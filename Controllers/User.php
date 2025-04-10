<?php
namespace Project;

use Project\Plans;
use Project\Server;

class User{

    // Attributes are set here (public and private)
    public $name;
    private $currentPlan;
    private $serverLists = [];

    public function subscribe(Plans $plan)
    {
        // In this scenario, upgrading or downgrading server plans are possible, as long the current customer does not subscribe to the same plan for more than one time.
        print "Action: Subscribing to " . $plan->getPlanType() . "\n";

        // Occurs if the user have not subscribed to any plan yet, or wanted to change plan.
        if ($this->currentPlan === null || $this->currentPlan->getPlanType() !== $plan->getPlanType()) {
            $this->currentPlan = $plan;
            print "Success => Successfully subscribed to " . $plan->getPlanType() . "\n\n";
        }

        // Occurs if the user reattempts to subscribe the same plan again.
        elseif ($this->currentPlan->getPlanType() == $plan->getPlanType()) {
            print "Error => User is already subscribed to " . $plan->getPlanType() . "\n\n";
        }
    }

    public function connectServer(Server $server)
    {
        print("Action: Connecting to server ".$server->name."\n");

        // Occurs if the user has not subscribed to any plans.
        if ($this->currentPlan === null){
            print "Error => User is not subscribed to any RunCloud plans\n\n";
        }
        else {
            if (count($this->serverLists) >= $this->currentPlan->getServerLimit()) {
                print "Error => User has Exceeded the maximum number of allowed servers for ". $this->currentPlan->getPlanType() . "\n\n";
                return;
            }

            $this->serverLists[] = $server;
            print "Success => Successfully established connection to server " . $server->name . "\n\n";
        }
    }

    public function unsubscribe()
    {
        //Occurs if the user decides to unsubscribe current plan.
        if ($this->currentPlan != null) {
            print "Success => User has successfully unsubscribed from RunCloud " . $this->currentPlan->getPlanType() . ".\n";
            $this->currentPlan = null;
            print "Thank you for using RunCloud as your trusted server partner!\nWe hope to see you again in the future!\n\n";
        }

        // Occurs if the user is not subscribed to any plans.
        else {
            print "Error => User is not subscribed to any RunCloud plans.\n\n";
        }
    }
}