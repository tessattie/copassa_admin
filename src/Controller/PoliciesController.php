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



    public function cronpoliciesforrenewal(){
       $policies = $this->Policies->find("all");  
       foreach($policies as $policy){
        $this->setrenewals($policy);
       }
       die("done with setting renewals");
    }


    public function setrenewals($policy, $current_year = false){
        ini_set("memory_limit","-1");
        $this->loadModel("Prenewals");
        if($current_year == false){
            $current_year = date("Y");
        }
        // set the renewals we have to create 
        $renewal_status = $this->Prenewals->find("all", array("conditions" => array("policy_id" => $policy->id), "order" => array("renewal_date")))->first();
        if(empty($renewal_status) || $renewal_status->policy_status = 1){
            $mode = $policy->mode; 
            $effective_date = $policy->effective_date->i18nFormat('yyyy-MM-dd');
            $renewals = [];
            $next_renewal =  date("Y-m-d", strtotime("+".$mode." months", strtotime($effective_date)));
            while($next_renewal  <= $current_year."-12-31"){
                $year = date("Y", strtotime($next_renewal)); 
                if($year == $current_year){
                    array_push($renewals, $next_renewal);
                }
                $next_renewal =  date("Y-m-d", strtotime("+".$mode." months", strtotime($next_renewal)));
            }

            foreach($renewals as $renewal){
                if(date("Y-m-d") <= $renewal){
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
}
