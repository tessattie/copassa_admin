<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Prenewals Controller
 *
 * @property \App\Model\Table\PrenewalsTable $Prenewals
 * @method \App\Model\Entity\Prenewal[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PrenewalsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Policies', 'Tenants'],
        ];
        $prenewals = $this->paginate($this->Prenewals);

        $this->set(compact('prenewals'));
    }

    /**
     * View method
     *
     * @param string|null $id Prenewal id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $prenewal = $this->Prenewals->get($id, [
            'contain' => ['Policies', 'Tenants'],
        ]);

        $this->set(compact('prenewal'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $prenewal = $this->Prenewals->newEmptyEntity();
        if ($this->request->is('post')) {
            $prenewal = $this->Prenewals->patchEntity($prenewal, $this->request->getData());
            if ($this->Prenewals->save($prenewal)) {
                $this->Flash->success(__('The prenewal has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The prenewal could not be saved. Please, try again.'));
        }
        $policies = $this->Prenewals->Policies->find('list', ['limit' => 200]);
        $tenants = $this->Prenewals->Tenants->find('list', ['limit' => 200]);
        $this->set(compact('prenewal', 'policies', 'tenants'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Prenewal id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $prenewal = $this->Prenewals->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $prenewal = $this->Prenewals->patchEntity($prenewal, $this->request->getData());
            if ($this->Prenewals->save($prenewal)) {
                $this->Flash->success(__('The prenewal has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The prenewal could not be saved. Please, try again.'));
        }
        $policies = $this->Prenewals->Policies->find('list', ['limit' => 200]);
        $tenants = $this->Prenewals->Tenants->find('list', ['limit' => 200]);
        $this->set(compact('prenewal', 'policies', 'tenants'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Prenewal id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $prenewal = $this->Prenewals->get($id);
        if ($this->Prenewals->delete($prenewal)) {
            $this->Flash->success(__('The prenewal has been deleted.'));
        } else {
            $this->Flash->error(__('The prenewal could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
