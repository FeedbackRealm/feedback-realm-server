<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Feedback;
use App\Model\Table\FeedbacksTable;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Datasource\ResultSetInterface;
use Cake\Http\Response;

/**
 * Feedbacks Controller
 *
 * @property FeedbacksTable $Feedbacks
 * @method Feedback[]|ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeedbacksController extends AppController
{
    /**
     * Index method
     *
     * @return void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Apps', 'AppUsers'],
        ];
        $feedbacks = $this->paginate($this->Feedbacks);

        $this->set(compact('feedbacks'));
    }

    /**
     * View method
     *
     * @param string|null $id Feedback id.
     * @return void Renders view
     * @throws RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $feedback = $this->Feedbacks->get($id, [
            'contain' => ['Apps', 'AppUsers'],
        ]);

        $this->set(compact('feedback'));
    }

    /**
     * Add method
     *
     * @return Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $feedback = $this->Feedbacks->newEmptyEntity();
        if ($this->request->is('post')) {
            $feedback = $this->Feedbacks->patchEntity($feedback, $this->request->getData());
            if ($this->Feedbacks->save($feedback)) {
                $this->Flash->success(__('The feedback has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The feedback could not be saved. Please, try again.'));
        }
        $apps = $this->Feedbacks->Apps->find('list', ['limit' => 200])->all();
        $appUsers = $this->Feedbacks->AppUsers->find('list', ['limit' => 200])->all();
        $this->set(compact('feedback', 'apps', 'appUsers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Feedback id.
     * @return Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $feedback = $this->Feedbacks->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $feedback = $this->Feedbacks->patchEntity($feedback, $this->request->getData());
            if ($this->Feedbacks->save($feedback)) {
                $this->Flash->success(__('The feedback has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The feedback could not be saved. Please, try again.'));
        }
        $apps = $this->Feedbacks->Apps->find('list', ['limit' => 200])->all();
        $appUsers = $this->Feedbacks->AppUsers->find('list', ['limit' => 200])->all();
        $this->set(compact('feedback', 'apps', 'appUsers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Feedback id.
     * @return Response|null Redirects to index.
     * @throws RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null): ?Response
    {
        $this->request->allowMethod(['post', 'delete']);
        $feedback = $this->Feedbacks->get($id);
        if ($this->Feedbacks->delete($feedback)) {
            $this->Flash->success(__('The feedback has been deleted.'));
        } else {
            $this->Flash->error(__('The feedback could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
