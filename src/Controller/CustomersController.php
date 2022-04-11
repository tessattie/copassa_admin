<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

/**
 * Customers Controller
 *
 * @property \App\Model\Table\CustomersTable $Customers
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CustomersController extends AppController
{

    public function beforeFilter(EventInterface $event){
        parent::beforeFilter($event);
        $this->set('area_codes', $this->Customers->area_codes);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->savelog(200, "Accessed policy holder page", 1, 3, "", "");
        $filter_country = $this->session->read("filter_country");
          $customers = $this->Customers->find("all")->contain(['Users', 'Countries', 'Policies' => 'Companies']);  

        $this->set(compact('customers', 'filter_country'));
    }

    /**
     * View method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => ['Notes' => ['sort' => 'Notes.created DESC', 'Users'], 'Countries', 'Users', 'Payments' => ['Users', 'Rates', 'Policies'], 'Policies' => ['Companies', 'Options', 'Users']],
        ]);
        $note = $this->Customers->Notes->newEmptyEntity();

        $this->set(compact('customer', 'note'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customer = $this->Customers->newEmptyEntity();
        if ($this->request->is('post')) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            $customer->user_id = $this->Auth->user()['id'];
            if ($ident = $this->Customers->save($customer)) {
                $this->savelog(200, "Created policy holder", 1, 1, "", json_encode($customer));
                $this->Flash->success(__('The policy holder has been saved.'));

                return $this->redirect(['controller' => 'policies', 'action' => 'add', $ident['id']]);
            }
            $this->savelog(500, "Tempted to create policy holder", 0, 1, "", json_encode($customer));
            $this->Flash->error(__('The policy holder could not be saved. Please, try again.'));
        }
        $countries = $this->Countries->find("list");
        $this->set(compact('customer', 'countries'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => ['Policies' => ['Users', 'Companies', 'Options']]
        ]);
        $old_data = json_encode($customer);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            if ($this->Customers->save($customer)){
                $this->savelog(200, "Edited policy holder", 1, 2, $old_data, json_encode($customer));
                $this->Flash->success(__('The customer has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->savelog(500, "Tempted to edit policy holder", 0, 2, $old_data, json_encode($customer));
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $countries = $this->Countries->find("list");
        $this->set(compact('customer', 'countries'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete', 'get']);
        $customer = $this->Customers->get($id);
        if ($this->Customers->delete($customer)) {
            $this->Flash->success(__('The customer has been deleted.'));
        } else {
            $this->Flash->error(__('The customer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    

    public function report(){
        
    }
}
