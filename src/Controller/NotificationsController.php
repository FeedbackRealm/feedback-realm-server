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
     * @inheritDoc
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->Authorization->skipAuthorization();
    }

    /**
     * Index method
     *
     * @return void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Apps'],
            'conditions' => [
                'Notifications.user_id' => $this->getAuthUser()->id,
            ],
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
            'conditions' => [
                'Notifications.user_id' => $this->getAuthUser()->id,
            ],
        ]);

        $this->set(compact('notification'));
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
        $notification = $this->Notifications->get($id, [
            'conditions' => [
                'Notifications.user_id' => $this->getAuthUser()->id,
            ],
        ]);
        if ($this->Notifications->delete($notification)) {
            $this->Flash->success(__('The notification has been deleted.'));
        } else {
            $this->Flash->error(__('The notification could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
