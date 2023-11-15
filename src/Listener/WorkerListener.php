<?php
declare(strict_types=1);

namespace App\Listener;

use Cake\Event\EventInterface;
use Cake\Event\EventListenerInterface;
use Cake\Log\LogTrait;
use Cake\Queue\Job\Message as JobMessage;
use Exception;
use Interop\Queue\Message;
use Psr\Log\LogLevel;

class WorkerListener implements EventListenerInterface
{
    use LogTrait;

    /**
     * @inheritDoc
     */
    public function implementedEvents(): array
    {
        return [
            'Processor.message.exception' => 'processorMessageException',
            'Processor.message.invalid' => 'processorMessageInvalid',
            'Processor.message.reject' => 'processorMessageReject',
            'Processor.message.success' => 'processorMessageSuccess',
            'Processor.message.failure' => 'processorMessageFailure',
            'Processor.message.seen' => 'processorMessageSeen',
            'Processor.message.start' => 'processorMessageStart',
        ];
    }

    /**
     * Dispatched when a message is seen
     *
     * @param EventInterface $event the event
     * @param Message $message the message
     * @return void
     */
    public function processorMessageSeen(EventInterface $event, Message $message)
    {
        $this->log(__METHOD__, LogLevel::DEBUG);
    }

    /**
     * Dispatched before a message is started
     *
     * @param EventInterface $event the event
     * @param JobMessage $message the job message
     * @return void
     */
    public function processorMessageStart(EventInterface $event, JobMessage $message)
    {
        $this->log(__METHOD__, LogLevel::DEBUG);
    }

    /**
     * Dispatched when a message completes and is to be rejected
     *
     * @param EventInterface $event the event
     * @param JobMessage $message the job message
     * @return void
     */
    public function processorMessageSuccess(EventInterface $event, JobMessage $message)
    {
        $this->log(__METHOD__, LogLevel::DEBUG);
    }

    /**
     * Dispatched when a message completes and is to be rejected
     *
     * @param EventInterface $event the event
     * @param JobMessage $message the job message
     * @param Exception $exception the caught exception
     * @return void
     */
    public function processorMessageException(EventInterface $event, JobMessage $message, Exception $exception)
    {
        $this->log(__METHOD__, LogLevel::DEBUG);
        $this->log($exception->getMessage(), LogLevel::ERROR);
    }

    /**
     * Dispatched when a message has an invalid callable
     *
     * @param EventInterface $event the event
     * @param JobMessage $message the job message
     * @return void
     */
    public function processorMessageInvalid(EventInterface $event, JobMessage $message)
    {
        $this->log(__METHOD__, LogLevel::DEBUG);
    }

    /**
     * Dispatched when a message completes and is to be rejected
     *
     * @param EventInterface $event the event
     * @param JobMessage $message the job message
     * @return void
     */
    public function processorMessageReject(EventInterface $event, JobMessage $message)
    {
        $this->log(__METHOD__, LogLevel::DEBUG);
    }

    /**
     * Dispatched when a message completes and is to be acknowledged
     *
     * @param EventInterface $event the event
     * @param JobMessage $message the job message
     * @return void
     */
    public function processorMessageFailure(EventInterface $event, JobMessage $message)
    {
        $this->log(__METHOD__, LogLevel::DEBUG);
    }
}
