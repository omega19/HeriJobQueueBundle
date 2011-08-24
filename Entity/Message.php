<?php

namespace Heri\JobQueueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Heri\JobQueueBundle\Entity\Message
 *
 * @ORM\Table(name="message")
 * @ORM\Entity
 */
class Message
{
    /**
     * @var bigint $messageId
     *
     * @ORM\Column(name="message_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $messageId;

    /**
     * @var integer $queueId
     *
     * @ORM\Column(name="queue_id", type="integer", nullable=false)
     */
    private $queueId;

    /**
     * @var string $handle
     *
     * @ORM\Column(name="handle", type="string", length=32, nullable=true)
     */
    private $handle;

    /**
     * @var text $body
     *
     * @ORM\Column(name="body", type="text", nullable=false)
     */
    private $body;

    /**
     * @var string $md5
     *
     * @ORM\Column(name="md5", type="string", length=32, nullable=false)
     */
    private $md5;

    /**
     * @var decimal $timeout
     *
     * @ORM\Column(name="timeout", type="decimal", nullable=true)
     */
    private $timeout;

    /**
     * @var integer $created
     *
     * @ORM\Column(name="created", type="integer", nullable=false)
     */
    private $created;

    /**
     * @var boolean $failed
     *
     * @ORM\Column(name="failed", type="boolean", nullable=false)
     */
    private $failed;

    /**
     * @var boolean $ended
     *
     * @ORM\Column(name="ended", type="boolean", nullable=false)
     */
    private $ended;



    /**
     * Get messageId
     *
     * @return bigint 
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * Set queueId
     *
     * @param integer $queueId
     */
    public function setQueueId($queueId)
    {
        $this->queueId = $queueId;
    }

    /**
     * Get queueId
     *
     * @return integer 
     */
    public function getQueueId()
    {
        return $this->queueId;
    }

    /**
     * Set handle
     *
     * @param string $handle
     */
    public function setHandle($handle)
    {
        $this->handle = $handle;
    }

    /**
     * Get handle
     *
     * @return string 
     */
    public function getHandle()
    {
        return $this->handle;
    }

    /**
     * Set body
     *
     * @param text $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * Get body
     *
     * @return text 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set md5
     *
     * @param string $md5
     */
    public function setMd5($md5)
    {
        $this->md5 = $md5;
    }

    /**
     * Get md5
     *
     * @return string 
     */
    public function getMd5()
    {
        return $this->md5;
    }

    /**
     * Set timeout
     *
     * @param decimal $timeout
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
    }

    /**
     * Get timeout
     *
     * @return decimal 
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * Set created
     *
     * @param integer $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * Get created
     *
     * @return integer 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set failed
     *
     * @param boolean $failed
     */
    public function setFailed($failed)
    {
        $this->failed = $failed;
    }

    /**
     * Get failed
     *
     * @return boolean 
     */
    public function getFailed()
    {
        return $this->failed;
    }

    /**
     * Set ended
     *
     * @param boolean $ended
     */
    public function setEnded($ended)
    {
        $this->ended = $ended;
    }

    /**
     * Get ended
     *
     * @return boolean 
     */
    public function getEnded()
    {
        return $this->ended;
    }
}