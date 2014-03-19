<?php

/*
 * This file is part of HeriJobQueueBundle.
 *
 * (c) Alexandre Mogère
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Heri\Bundle\JobQueueBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\Console\Input\ArrayInput;

class QueueService
{
    public
        $command,
        $adapter
    ;
    
    protected
        $em,
        $logger,
        $output,
        $config,
        $queue
    ;
    
    public function __construct(Logger $logger, EntityManager $em)
    {
        $this->logger = $logger;
        $this->em = $em;
    }
    
    public function configure($name)
    {
        $this->config = array(
            'name' => $name,
        );
        
        $this->queue = new \ZendQueue\Queue($this->adapter, $this->config);
        $this->queue->createQueue($name);
    }
    
    public function receive($maxMessages = 1)
    {
        $messages = $this->queue->receive($maxMessages);
        if ($messages && $messages->count() > 0) {
            $this->execute($messages);
        }
    }
    
    /**
     * @param array $args
     */
    public function push(array $args)
    {
        if (!is_null($this->queue)) {
            $this->queue->send(json_encode($args));
        }
    }
    
    /**
     * @param array $args
     * @deprecated
     */
    public function sync(array $args)
    {
        return $this->push($args);
    }
    
    protected function execute($messages)
    {
        $this->output = $this->command->getOutput();
        
        foreach ($messages as $message) {
            $output = date('H:i:s') . ' - ' . ($message->failed ? 'failed' : 'new');
            $output .= '['.$message->id.']';
            
            $this->output->writeLn('<comment>' . $output . '</comment>');
            
            $args = (array) json_decode($message->body);
            
            try {
                $argument = isset($args['argument']) ? (array) $args['argument'] : array();
                $input = new ArrayInput(array_merge(array(''), $argument));
                $command = $this->command->getApplication()->find($args['command']);
                $returnCode = $command->run($input, $this->output);
                
                $this->queue->deleteMessage($message);
                
                $this->output->writeLn('<info>Ended</info>');
            } catch (\Exception $e) {
                $this->adapter->logException($message, $e);
                $this->output->writeLn('<error>Failed</error> ' . $e->getMessage());
            }
        }
    }
}