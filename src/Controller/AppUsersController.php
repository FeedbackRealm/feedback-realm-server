<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * AppUsers Controller
 *
 * @property \App\Model\Table\AppUsersTable $AppUsers
 * @method \App\Model\Entity\AppUser[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AppUsersController extends AppController
{
    /**
     * Index method
     *
     * @return void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Apps'],
        ];
        $appUsers = $this->paginate($this->AppUsers);

        $this->set(compact('appUsers'));
    }

    /**
     * View method
     *
     * @param string|null $id App User id.
     * @return void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $appUser = $this->AppUsers->get($id, [
            'contain' => ['Apps'],
        ]);

        $feedbacks = $this->paginate(
            $this->AppUsers->Feedbacks
                ->find()
                ->limit(100)
                ->matching('AppUsers', fn(\Cake\ORM\Query $q) => $q->where(['app_user_id' => $id])),
            ['scope' => 'feedbacks']
        );
        $this->set(compact('appUser', 'feedbacks'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $appUser = $this->AppUsers->newEmptyEntity();
        if ($this->request->is('post')) {
            $appUser = $this->AppUsers->patchEntity($appUser, $this->request->getData());
            if ($this->AppUsers->save($appUser)) {
                $this->Flash->success(__('The app user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The app user could not be saved. Please, try again.'));
        }
        $apps = $this->AppUsers->Apps->find('list', ['limit' => 200])->all();
        $this->set(compact('appUser', 'apps'));
    }

    /**
     * Edit method
     *
     * @param string|null $id App User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $appUser = $this->AppUsers->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $appUser = $this->AppUsers->patchEntity($appUser, $this->request->getData());
            if ($this->AppUsers->save($appUser)) {
                $this->Flash->success(__('The app user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The app user could not be saved. Please, try again.'));
        }
        $apps = $this->AppUsers->Apps->find('list', ['limit' => 200])->all();
        $this->set(compact('appUser', 'apps'));
    }

    /**
     * Delete method
     *
     * @param string|null $id App User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null): ?\Cake\Http\Response
    {
        $this->request->allowMethod(['post', 'delete']);
        $appUser = $this->AppUsers->get($id);
        if ($this->AppUsers->delete($appUser)) {
            $this->Flash->success(__('The app user has been deleted.'));
        } else {
            $this->Flash->error(__('The app user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
