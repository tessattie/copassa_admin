<?php
declare(strict_types=1);

namespace App\Controller;

use FPDF;

/**
 * Policies Controller
 *
 * @property \App\Model\Table\PoliciesTable $Policies
 * @method \App\Model\Entity\Policy[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PoliciesController extends AppController
{
    public function renew(){
       $policies = $this->Policies->find("all", array("conditions" => array()));  
       foreach($policies as $policy){
            $this->update($policy);
       }

       die("done with renewals");
    }
    public function update($policy){
        ini_set("memory_limit","-1");
        $this->loadModel("Prenewals");
        $renewal_year_start = date("Y-m-d");
        $renewal_year_end = date("Y-m-d", strtotime("+3 months", strtotime($renewal_year_start))); 
        // set the renewals we have to create 
        $renewal_status = $this->Prenewals->find("all", array("conditions" => array("policy_id" => $policy->id), "order" => array("renewal_date DESC")))->first();
        if(empty($renewal_status) || $renewal_status->policy_status == 1){
            $mode = $policy->mode; 
            $effective_date = $policy->effective_date->i18nFormat('yyyy-MM-dd');
            $renewals = [];
            $next_renewal =  $effective_date;
            while($next_renewal  < $renewal_year_end){
                $year = date("Y", strtotime($next_renewal)); 
                if($next_renewal  <= $renewal_year_end && $next_renewal >= $renewal_year_start){
                    array_push($renewals, $next_renewal);
                }
                $next_renewal =  date("Y-m-d", strtotime("+".$mode." months", strtotime($next_renewal)));
            }


            foreach($renewals as $renewal){
                $renewals = $this->Prenewals->find("all", array("conditions" => array("renewal_date" => $renewal, "policy_id" => $policy->id)));
                if($renewals->count() == 0){
                    // create renewal
                    $prenewal = $this->Prenewals->newEmptyEntity(); 
                    $prenewal->renewal_date = $renewal; 
                    $prenewal->policy_id = $policy->id; 
                    $prenewal->premium = $policy->premium; 
                    $prenewal->fee = $policy->fee; 
                    $prenewal->tenant_id = $policy->tenant_id;
                    $prenewal->policy_status = 1; 
                    $prenewal->status = 1;
                    // debug($prenewal); die();
                    $this->Prenewals->save($prenewal);
                }
            }
        }
    }
}
