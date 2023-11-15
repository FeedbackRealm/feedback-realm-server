<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Team;
use App\Model\Table\TeamsTable;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Datasource\ResultSetInterface;
use Cake\Http\Response;
use Cake\ORM\Query;

/**
 * Teams Controller
 *
 * @property TeamsTable $Teams
 * @method Team[]|ResultSetInterface paginate($object = null, array $settings = [])
 */
class TeamsController extends AppController
{
    /**
     * Index method
     *
     * @return void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Apps'],
        ];
        $teams = $this->paginate($this->Teams);

        $this->set(compact('teams'));
    }

    /**
     * View method
     *
     * @param string|null $id Team id.
     * @return void Renders view
     * @throws RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $team = $this->Teams->get($id, [
            'contain' => ['Users', 'Apps'],
        ]);

        $notifications = $this->paginate(
            $this->Teams->Notifications
                ->find()
                ->limit(100)
                ->matching('Teams', fn(Query $q) => $q->where(['Array' => $id])),
            ['scope' => 'notifications']
        );
        $this->set(compact('team', 'notifications'));
    }

    /**
     * Add method
     *
     * @return Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $team = $this->Teams->newEmptyEntity();
        if ($this->request->is('post')) {
            $team = $this->Teams->patchEntity($team, $this->request->getData());
            if ($this->Teams->save($team)) {
                $this->Flash->success(__('The team has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The team could not be saved. Please, try again.'));
        }
        $users = $this->Teams->Users->find('list', ['limit' => 200])->all();
        $apps = $this->Teams->Apps->find('list', ['limit' => 200])->all();
        $this->set(compact('team', 'users', 'apps'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Team id.
     * @return Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $team = $this->Teams->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $team = $this->Teams->patchEntity($team, $this->request->getData());
            if ($this->Teams->save($team)) {
                $this->Flash->success(__('The team has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The team could not be saved. Please, try again.'));
        }
        $users = $this->Teams->Users->find('list', ['limit' => 200])->all();
        $apps = $this->Teams->Apps->find('list', ['limit' => 200])->all();
        $this->set(compact('team', 'users', 'apps'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Team id.
     * @return Response|null Redirects to index.
     * @throws RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null): ?Response
    {
        $this->request->allowMethod(['post', 'delete']);
        $team = $this->Teams->get($id);
        if ($this->Teams->delete($team)) {
            $this->Flash->success(__('The team has been deleted.'));
        } else {
            $this->Flash->error(__('The team could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}