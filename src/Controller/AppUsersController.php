<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\AppUser;
use App\Model\Table\AppUsersTable;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Datasource\ResultSetInterface;
use Cake\Http\Response;
use Cake\ORM\Query;

/**
 * AppUsers Controller
 *
 * @property AppUsersTable $AppUsers
 * @method AppUser[]|ResultSetInterface paginate($object = null, array $settings = [])
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
     * @throws RecordNotFoundException When record not found.
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
                ->matching('AppUsers', fn(Query $q) => $q->where(['app_user_id' => $id])),
            ['scope' => 'feedbacks']
        );
        $this->set(compact('appUser', 'feedbacks'));
    }

    /**
     * Add method
     *
     * @return Response|null|void Redirects on successful add, renders view otherwise.
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
     * @return Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws RecordNotFoundException When record not found.
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
     * @return Response|null Redirects to index.
     * @throws RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null): ?Response
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