<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Customer;
use App\Model\Table\CustomersTable;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Datasource\ResultSetInterface;
use Cake\Http\Response;
use Cake\ORM\Query;

/**
 * Customers Controller
 *
 * @property CustomersTable $Customers
 * @method Customer[]|ResultSetInterface paginate($object = null, array $settings = [])
 */
class CustomersController extends AppController
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
        $query = $this->Customers
            ->find()
            ->contain('Apps')
            ->orderDesc('Customers.created')
            ->innerJoin(['AppMembers' => 'app_members'], [
                'AppMembers.app_id = Customers.app_id',
                'AppMembers.user_id' => $this->getAuthUser()->id,
            ]);
        $showAppNames = true;
        if ($appId) {
            $query->where(['Customers.app_id' => $appId]);
            $showAppNames = false;
        }

        $customers = $this->paginate($query);

        $this->set(compact('customers', 'showAppNames'));
    }

    /**
     * View method
     *
     * @param string|null $id Customer id.
     * @return void Renders view
     * @throws RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => ['Apps'],
        ]);
        $this->Authorization->authorize($customer);
        $feedbacks = $this->paginate(
            $this->Customers->Feedbacks
                ->find()
                ->limit(100)
                ->matching('Customers', fn(Query $q) => $q->where(['customer_id' => $id])),
            ['scope' => 'feedbacks']
        );
        $this->set(compact('customer', 'feedbacks'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Customer id.
     * @return Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => ['Apps'],
        ]);
        $this->Authorization->authorize($customer);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData(), [
                'fields' => ['name', 'meta'],
            ]);
            $customer->last_updated_by = $this->getAuthUser()->id;
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));

                return $this->redirect(['action' => 'index', $customer->app_id]);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $this->set(compact('customer'));
    }
}
