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
     * @inheritDoc
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->Authorization->authorizeModel('index', 'add', 'view', 'edit', 'delete');
    }

    /**
     * Index method
     *
     * @param int|null $appId
     * @return void Renders view
     */
    public function index(?int $appId = null)
    {
        $query = $this->AppUsers
            ->find()
            ->contain('Apps')
            ->orderDesc('AppUsers.created')
            ->innerJoin('AppMembers', [
                'AppMembers.app_id = AppUsers.app_id',
                'AppMembers.user_id' => $this->getAuthUser()->id,
            ]);
        $showAppNames = true;
        if ($appId) {
            $query->where(['AppUsers.app_id' => $appId]);
            $showAppNames = false;
        }

        $appUsers = $this->paginate($query);

        $this->set(compact('appUsers', 'showAppNames'));
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
        $this->Authorization->authorize($appUser);
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
     * Edit method
     *
     * @param string|null $id App User id.
     * @return Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $appUser = $this->AppUsers->get($id, [
            'contain' => ['Apps'],
        ]);
        $this->Authorization->authorize($appUser);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $appUser = $this->AppUsers->patchEntity($appUser, $this->request->getData(), [
                'fields' => ['name', 'meta'],
            ]);
            if ($this->AppUsers->save($appUser)) {
                $this->Flash->success(__('The app user has been saved.'));

                return $this->redirect(['action' => 'index', $appUser->app_id]);
            }
            $this->Flash->error(__('The app user could not be saved. Please, try again.'));
        }
        $this->set(compact('appUser'));
    }
}
