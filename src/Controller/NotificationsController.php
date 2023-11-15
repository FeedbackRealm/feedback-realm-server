<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Notification;
use App\Model\Table\NotificationsTable;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Datasource\ResultSetInterface;
use Cake\Http\Response;

/**
 * Notifications Controller
 *
 * @property NotificationsTable $Notifications
 * @method Notification[]|ResultSetInterface paginate($object = null, array $settings = [])
 */
class NotificationsController extends AppController
{
    /**
     * Index method
     *
     * @return void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Apps', 'Users', 'Teams'],
        ];
        $notifications = $this->paginate($this->Notifications);

        $this->set(compact('notifications'));
    }

    /**
     * View method
     *
     * @param string|null $id Notification id.
     * @return void Renders view
     * @throws RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $notification = $this->Notifications->get($id, [
            'contain' => ['Apps', 'Users', 'Teams'],
        ]);

        $this->set(compact('notification'));
    }

    /**
     * Add method
     *
     * @return Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $notification = $this->Notifications->newEmptyEntity();
        if ($this->request->is('post')) {
            $notification = $this->Notifications->patchEntity($notification, $this->request->getData());
            if ($this->Notifications->save($notification)) {
                $this->Flash->success(__('The notification has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The notification could not be saved. Please, try again.'));
        }
        $apps = $this->Notifications->Apps->find('list', ['limit' => 200])->all();
        $users = $this->Notifications->Users->find('list', ['limit' => 200])->all();
        $teams = $this->Notifications->Teams->find('list', ['limit' => 200])->all();
        $this->set(compact('notification', 'apps', 'users', 'teams'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Notification id.
     * @return Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $notification = $this->Notifications->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $notification = $this->Notifications->patchEntity($notification, $this->request->getData());
            if ($this->Notifications->save($notification)) {
                $this->Flash->success(__('The notification has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The notification could not be saved. Please, try again.'));
        }
        $apps = $this->Notifications->Apps->find('list', ['limit' => 200])->all();
        $users = $this->Notifications->Users->find('list', ['limit' => 200])->all();
        $teams = $this->Notifications->Teams->find('list', ['limit' => 200])->all();
        $this->set(compact('notification', 'apps', 'users', 'teams'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Notification id.
     * @return Response|null Redirects to index.
     * @throws RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null): ?Response
    {
        $this->request->allowMethod(['post', 'delete']);
        $notification = $this->Notifications->get($id);
        if ($this->Notifications->delete($notification)) {
            $this->Flash->success(__('The notification has been deleted.'));
        } else {
            $this->Flash->error(__('The notification could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
