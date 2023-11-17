<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Feedback;
use App\Model\Table\FeedbacksTable;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Datasource\ResultSetInterface;

/**
 * Feedbacks Controller
 *
 * @property FeedbacksTable $Feedbacks
 * @method Feedback[]|ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeedbacksController extends AppController
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
        $query = $this->Feedbacks
            ->find()
            ->contain(['Apps', 'Customers'])
            ->orderDesc('Feedbacks.created')
            ->innerJoin('AppMembers', [
                'AppMembers.app_id = Feedbacks.app_id',
                'AppMembers.user_id' => $this->getAuthUser()->id,
            ]);
        $showAppNames = true;
        if ($appId) {
            $query->where(['Feedbacks.app_id' => $appId]);
            $showAppNames = false;
        }
        $feedbacks = $this->paginate($query);
        $this->set(compact('feedbacks', 'showAppNames'));
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
            'contain' => ['Apps', 'Customers'],
        ]);
        $this->Authorization->authorize($feedback);
        $this->set(compact('feedback'));
    }
}
