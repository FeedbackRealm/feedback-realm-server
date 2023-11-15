<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Table\UsersTable;
use Cake\Event\EventInterface;
use Cake\Http\Response;

/**
 * Auth Controller
 *
 * @property-read UsersTable $Users
 */
class AuthController extends AppController
{
    public $defaultTable = 'Users';

    /**
     * @inheritDoc
     */
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['login', 'register']);
    }

    /**
     * Redirects to the login screen
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->redirect('/auth/login');
    }

    /**
     * Logs the user in
     *
     * @return Response|void|null
     */
    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result && $result->isValid()) {
            // redirect to /articles after login success
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Apps',
                'action' => 'index',
            ]);

            return $this->redirect($redirect);
        }
        // display error if user submitted and authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid email or password'));
        }
    }

    /**
     * Log the user out
     *
     * @return Response|void|null
     */
    public function logout()
    {
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result && $result->isValid()) {
            $this->Authentication->logout();

            return $this->redirect(['controller' => 'Auth', 'action' => 'login']);
        }
    }

    /**
     * Registers the user
     *
     * @return Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function register()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('You have registered'));

                return $this->redirect(['controller' => 'Apps', 'action' => 'index']);
            }
            $this->Flash->error(__('We could not register you at this time. Please, try again.'));
        }
        $this->set(compact('user'));
    }
}
