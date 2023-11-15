<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Apps Controller
 *
 * @property \App\Model\Table\AppsTable $Apps
 * @method \App\Model\Entity\App[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AppsController extends AppController
{
    /**
     * Index method
     *
     * @return void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $apps = $this->paginate($this->Apps);

        $this->set(compact('apps'));
    }

    /**
     * View method
     *
     * @param string|null $id App id.
     * @return void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $app = $this->Apps->get($id, [
            'contain' => ['Users'],
        ]);

        $appUsers = $this->paginate(
            $this->Apps->AppUsers
                ->find()
                ->limit(100)
                ->matching('Apps', fn(\Cake\ORM\Query $q) => $q->where(['app_id' => $id])),
            ['scope' => 'appUsers']
        );
        $feedbacks = $this->paginate(
            $this->Apps->Feedbacks
                ->find()
                ->limit(100)
                ->matching('Apps', fn(\Cake\ORM\Query $q) => $q->where(['app_id' => $id])),
            ['scope' => 'feedbacks']
        );
        $notifications = $this->paginate(
            $this->Apps->Notifications
                ->find()
                ->limit(100)
                ->matching('Apps', fn(\Cake\ORM\Query $q) => $q->where(['app_id' => $id])),
            ['scope' => 'notifications']
        );
        $teams = $this->paginate(
            $this->Apps->Teams
                ->find()
                ->limit(100)
                ->matching('Apps', fn(\Cake\ORM\Query $q) => $q->where(['app_id' => $id])),
            ['scope' => 'teams']
        );
        $this->set(compact('app', 'appUsers', 'feedbacks', 'notifications', 'teams'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $app = $this->Apps->newEmptyEntity();
        if ($this->request->is('post')) {
            $app = $this->Apps->patchEntity($app, $this->request->getData());
            if ($this->Apps->save($app)) {
                $this->Flash->success(__('The app has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The app could not be saved. Please, try again.'));
        }
        $users = $this->Apps->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('app', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id App id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $app = $this->Apps->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $app = $this->Apps->patchEntity($app, $this->request->getData());
            if ($this->Apps->save($app)) {
                $this->Flash->success(__('The app has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The app could not be saved. Please, try again.'));
        }
        $users = $this->Apps->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('app', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id App id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null): ?\Cake\Http\Response
    {
        $this->request->allowMethod(['post', 'delete']);
        $app = $this->Apps->get($id);
        if ($this->Apps->delete($app)) {
            $this->Flash->success(__('The app has been deleted.'));
        } else {
            $this->Flash->error(__('The app could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
