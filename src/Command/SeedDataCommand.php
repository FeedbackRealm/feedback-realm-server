<?php
declare(strict_types=1);

namespace App\Command;

use App\Model\Entity\App;
use App\Model\Entity\Customer;
use App\Model\Entity\User;
use App\Model\Table\AppMembersTable;
use App\Model\Table\AppsTable;
use App\Model\Table\CustomersTable;
use App\Model\Table\FeedbacksTable;
use App\Model\Table\UsersTable;
use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\CommandInterface;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Table;
use Cake\Utility\Text;
use Exception;
use Faker\Factory;
use Faker\Generator;
use Throwable;

/**
 * SeedData command.
 *
 * @property Arguments $args
 * @property ConsoleIo $io
 * @property Generator $Faker
 * @property UsersTable|Table $Users
 * @property AppsTable|Table $Apps
 * @property CustomersTable|Table $Customers
 * @property AppMembersTable|Table $AppMembers
 * @property FeedbacksTable|Table $Feedbacks
 */
class SeedDataCommand extends Command
{
    protected const NUM_USERS = 9;
    protected const NUM_APPS = 9;
    protected const NUM_APP_MEMBERS = 4;
    protected const NUM_CUSTOMERS = 15;
    protected const NUM_FEEDBACKS = 5;

    /**
     * Hook method invoked by CakePHP when a command is about to be executed.
     *
     * Override this method and implement expensive/important setup steps that
     * should not run on every command run. This method will be called *before*
     * the options and arguments are validated and processed.
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->Faker = Factory::create();
        $this->Users = $this->fetchTable('Users');
        $this->Apps = $this->fetchTable('Apps');
        $this->Customers = $this->fetchTable('Customers');
        $this->AppMembers = $this->fetchTable('AppMembers');
        $this->Feedbacks = $this->fetchTable('Feedbacks');
    }

    /**
     * Hook method for defining this command's option parser.
     *
     * @see https://book.cakephp.org/4/en/console-commands/commands.html#defining-arguments-and-options
     * @param ConsoleOptionParser $parser The parser to be defined
     * @return ConsoleOptionParser The built parser.
     */
    public function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser = parent::buildOptionParser($parser);

        return $parser;
    }

    /**
     * Implement this method with your command's logic.
     *
     * @param Arguments $args The command arguments.
     * @param ConsoleIo $io The console io
     * @return int The exit code
     */
    public function execute(Arguments $args, ConsoleIo $io): int
    {
        try {
            $this->io = $io;
            $this->args = $args;
            $this->main();

            return CommandInterface::CODE_SUCCESS;
        } catch (Throwable $exception) {
            $io->error($exception->getMessage());

            return CommandInterface::CODE_ERROR;
        }
    }

    /**
     * @return void
     * @throws Exception
     */
    protected function main()
    {
        $users = $this->makeUsers(self::NUM_USERS);
        $users[] = $this->makeDefaultUser();
        $apps = $this->makeApps(self::NUM_APPS, $users);
        $this->makeAppMembers(self::NUM_APP_MEMBERS, $users, $apps);
        $customers = $this->makeCustomers(self::NUM_CUSTOMERS, $apps);
        $this->makeFeedbacks(self::NUM_FEEDBACKS, $customers);
    }

    /**
     * @return User|EntityInterface
     */
    protected function makeDefaultUser(): EntityInterface
    {
        $this->io->out('Creating default user');
        $entity = $this->Users->newEntity([
            'name' => env('DEFAULT_USER_NAME', $this->Faker->name),
            'email' => env('DEFAULT_USER_EMAIL', $this->Faker->unique()->email),
            'password' => env('DEFAULT_USER_PASSWORD', $this->Faker->password(8)),
            'email_verified' => true,
        ]);

        $this->Users->saveOrFail($entity);

        return $entity;
    }

    /**
     * @param int $count
     * @return User[]|EntityInterface[]
     * @throws Exception
     */
    protected function makeUsers(int $count = 10): array
    {
        $this->io->out('Creating users');
        $data = [];
        for ($i = 0; $i < $count; $i++) {
            $data[] = [
                'name' => $this->Faker->name(),
                'email' => $this->Faker->unique()->email(),
                'password' => $this->Faker->password(8),
                'email_verified' => true,
            ];
        }

        $entities = $this->Users->newEntities($data);
        $this->Users->saveManyOrFail($entities);

        return $entities;
    }

    /**
     * @param int $count
     * @param User[]|EntityInterface[] $users
     * @return App[]|EntityInterface[]
     * @throws Exception
     */
    protected function makeApps(int $count, array $users): array
    {
        $this->io->out('Creating apps');
        $data = [];
        for ($i = 0; $i < $count; $i++) {
            /** @var User $creator */
            $creator = $this->Faker->randomElement($users);
            $data[] = [
                'user_id' => $creator->id,
                'name' => $this->Faker->unique()->company,
                'description' => $this->Faker->sentences(3, true),
            ];
        }

        $entities = $this->Apps->newEntities($data);
        $this->Apps->saveManyOrFail($entities);

        return $entities;
    }

    /**
     * @param int $count
     * @param User[]|EntityInterface[] $users
     * @param App[]|EntityInterface[] $apps
     * @return void
     * @throws Exception
     */
    protected function makeAppMembers(int $count, array $users, array $apps): void
    {
        $this->io->out('Creating app members');
        foreach ($apps as $app) {
            for ($i = 0; $i < $count; $i++) {
                /** @var User $member */
                $member = $this->Faker->randomElement($users);
                $this->AppMembers->findOrCreate([
                    'user_id' => $member->get('id'),
                    'app_id' => $app->get('id'),
                ]);
            }
        }
    }

    /**
     * @param int $count
     * @param App[]|EntityInterface[] $apps
     * @return Customer[]|EntityInterface[]
     * @throws Exception
     */
    protected function makeCustomers(int $count, array $apps): array
    {
        $this->io->out('Creating customers');
        $data = [];
        foreach ($apps as $app) {
            $maxCount = $this->Faker->numberBetween(0, $count);
            for ($i = 0; $i < $maxCount; $i++) {
                $data[] = [
                    'app_id' => $app->get('id'),
                    'identifier' => Text::uuid(),
                    'name' => $this->Faker->name,
                    'meta' => json_encode([
                        'title' => $this->Faker->title,
                        'city' => $this->Faker->city(),
                    ]),
                ];
            }
        }
        $entities = $this->Customers->newEntities($data);
        $this->Customers->saveManyOrFail($entities);

        return $entities;
    }

    /**
     * @param int $count
     * @param Customer[]|EntityInterface[] $customers
     * @return void
     * @throws Exception
     */
    protected function makeFeedBacks(int $count, array $customers): void
    {
        $this->io->out('Creating feedbacks');
        $data = [];
        foreach ($customers as $customer) {
            $maxCount = $this->Faker->numberBetween(0, $count);
            for ($i = 0; $i < $maxCount; $i++) {
                $data[] = [
                    'app_id' => $customer->get('app_id'),
                    'customer_id' => $customer->get('id'),
                    'type' => $this->Faker->randomElement(['Bug', 'Feature Request', 'Comment', 'Question']),
                    'title' => $this->Faker->words($this->Faker->numberBetween(1, 5), true),
                    'body' => $this->Faker->sentences($this->Faker->numberBetween(1, 5), true),
                    'meta' => json_encode([
                        $this->Faker->word() => $this->Faker->words(2, true),
                    ]),
                ];
            }
        }

        $entities = $this->Feedbacks->newEntities($data);
        $this->Feedbacks->saveManyOrFail($entities);
    }
}
