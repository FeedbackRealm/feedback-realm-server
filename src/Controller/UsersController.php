<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\User;
use App\Model\Table\UsersTable;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Datasource\ResultSetInterface;
use Cake\Http\Response;
use Cake\ORM\Query;

/**
 * Users Controller
 *
 * @property UsersTable $Users
 * @method User[]|ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * @inheritDoc
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->Authorization->authorizeModel('index', 'add', 'view', 'edit', 'delete');
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void Renders view
     * @throws RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($user);
        $apps = $this->paginate(
            $this->Users->Apps
                ->find()
                ->limit(100)
                ->matching('Users', fn(Query $q) => $q->where(['user_id' => $id])),
            ['scope' => 'apps']
        );
        $notifications = $this->paginate(
            $this->Users->Notifications
                ->find()
                ->limit(100)
                ->matching('Users', fn(Query $q) => $q->where(['user_id' => $id])),
            ['scope' => 'notifications']
        );
        $teams = $this->paginate(
            $this->Users->Teams
                ->find()
                ->limit(100)
                ->matching('Users', fn(Query $q) => $q->where(['user_id' => $id])),
            ['scope' => 'teams']
        );
        $this->set(compact('user', 'apps', 'notifications', 'teams'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($user);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }
}
