<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Feedbacks Controller
 *
 * @property \App\Model\Table\FeedbacksTable $Feedbacks
 * @method \App\Model\Entity\Feedback[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
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
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
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
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
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
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
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
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null): ?\Cake\Http\Response
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
