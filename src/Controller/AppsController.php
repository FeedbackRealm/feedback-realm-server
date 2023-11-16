<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\App;
use App\Model\Table\AppsTable;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Datasource\ResultSetInterface;
use Cake\Http\Response;
use Cake\ORM\Query;

/**
 * Apps Controller
 *
 * @property AppsTable $Apps
 * @method App[]|ResultSetInterface paginate($object = null, array $settings = [])
 */
class AppsController extends AppController
{
    /**
     * @inheritDoc
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->Authorization->authorizeModel('index', 'add', 'edit', 'delete', 'view');
    }

    /**
     * Index method
     *
     * @return void Renders view
     */
    public function index()
    {
        $query = $this->Apps
            ->find()
            ->orderDesc('Apps.created')
            ->contain('Users')
            ->innerJoinWith('Teams', fn(Query $q) => $q->where([
                'Teams.user_id' => $this->getAuthUser()->id,
            ]));
        $apps = $this->paginate($query);

        $this->set(compact('apps'));
    }

    /**
     * View method
     *
     * @param string|null $id App id.
     * @return void Renders view
     * @throws RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $app = $this->Apps->get($id, [
            'contain' => ['Users'],
        ]);
        $this->Authorization->authorize($app);
        $appUsers = $this->paginate(
            $this->Apps->AppUsers
                ->find()
                ->limit(100)
                ->matching('Apps', fn(Query $q) => $q->where(['app_id' => $id])),
            ['scope' => 'appUsers']
        );
        $feedbacks = $this->paginate(
            $this->Apps->Feedbacks
                ->find()
                ->limit(100)
                ->matching('Apps', fn(Query $q) => $q->where(['app_id' => $id])),
            ['scope' => 'feedbacks']
        );
        $notifications = $this->paginate(
            $this->Apps->Notifications
                ->find()
                ->limit(100)
                ->matching('Apps', fn(Query $q) => $q->where(['app_id' => $id])),
            ['scope' => 'notifications']
        );
        $teams = $this->paginate(
            $this->Apps->Teams
                ->find()
                ->limit(100)
                ->matching('Apps', fn(Query $q) => $q->where(['app_id' => $id])),
            ['scope' => 'teams']
        );
        $this->set(compact('app', 'appUsers', 'feedbacks', 'notifications', 'teams'));
    }

    /**
     * Add method
     *
     * @return Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $app = $this->Apps->newEmptyEntity();
        if ($this->request->is('post')) {
            $app->user_id = $this->getAuthUser()->id;
            $app = $this->Apps->patchEntity($app, $this->request->getData(), [
                'fields' => ['name', 'logo', 'description'],
            ]);
            if ($this->Apps->save($app)) {
                $this->Flash->success(__('The app has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The app could not be saved. Please, try again.'));
        }
        $this->set(compact('app'));
    }

    /**
     * Edit method
     *
     * @param string|null $id App id.
     * @return Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $app = $this->Apps->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($app);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $app = $this->Apps->patchEntity($app, $this->request->getData(), [
                'fields' => ['name', 'logo', 'description'],
            ]);
            if ($this->Apps->save($app)) {
                $this->Flash->success(__('The app has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The app could not be saved. Please, try again.'));
        }
        $this->set(compact('app'));
    }

    /**
     * Delete method
     *
     * @param string|null $id App id.
     * @return Response|null Redirects to index.
     * @throws RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null): ?Response
    {
        $this->request->allowMethod(['post', 'delete']);
        $app = $this->Apps->get($id);
        $this->Authorization->authorize($app);
        if ($this->Apps->delete($app)) {
            $this->Flash->success(__('The app has been deleted.'));
        } else {
            $this->Flash->error(__('The app could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
