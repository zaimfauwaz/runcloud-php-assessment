<?php
namespace Project;

use Project\Plans;
use Project\Server;

// Important Note: sleep() command is used to imitate the delays/flows as performed by the actual operations (such as saving information into database).
// In actual operations, these delays are vary depending on the time taken by the operation to complete.

class User{

    // Attributes are set here (public and private)
    public $name;
    private $currentPlan;
    private $serverLists = [];

    public function subscribe(Plans $plan)
    {
        sleep(1);
        // In this scenario, upgrading or downgrading server plans are possible, as long the current customer does not subscribe to the same plan for more than one time.
        print "Action: Subscribing to " . $plan->getPlanType() . "\n";

        sleep(2.5);
        // Occurs if the user have not subscribed to any plan yet, or wanted to change plan.
        if ($this->currentPlan === null || $this->currentPlan->getPlanType() !== $plan->getPlanType()) {
            $this->currentPlan = $plan;
            print "Success => Successfully subscribed to " . $plan->getPlanType() . "\n\n";
        }

        // Occurs if the user reattempts to subscribe the same plan again.
        elseif ($this->currentPlan->getPlanType() == $plan->getPlanType()) {
            print "Error => User is already subscribed to " . $plan->getPlanType() . "\n\n";
        }
        sleep(1);
    }

    public function connectServer(Server $server)
    {
        sleep(1);
        print("Action: Connecting to server ".$server->name."\n");

        sleep(2.5);
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
            $this->showInfo($this->name, $this->currentPlan->getPlanType(), $this->serverLists);
        }
        sleep(1);
    }

    public function unsubscribe()
    {
        sleep(1);
        print("Action: Unsubscribing current plan ". $this->currentPlan->getPlanType() ."\n");

        sleep(2.5);
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
        sleep(1);
    }

    // For table output purposes
    private function showInfo($name, $plan, $servers){
        sleep(2.5);
        print "\n".str_repeat('-', 60);
        // Name
        print "\nUser's Name\t\t|   ".$name;
        print "\n".str_repeat('-', 60);
        // Plan
        print "\nCurrent Plan\t\t|   ".$plan;
        print "\n".str_repeat('-', 60);
        // Servers
        print "\nServers Available\t|\n";
        foreach ($servers as $server) {
            print "\t\t\t|   " . $server->name . "\t[" . $server->ipAddress . "]\n";
        }
        print str_repeat('-', 60)."\n"."\n";
        sleep(1);
    }
}