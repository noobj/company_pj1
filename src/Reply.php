<?php

/**
 * @Entity
 * @Table(name="reply")
 */
Class Reply
{
    /**
     * @var integer
     *
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * mapping on Message id
     *
     * @var integer
     *
     * @ManyToOne(targetEntity="Message")
     * @JoinColumn(name="message_id", referencedColumnName="id")
     */
    private $message;

    /**
     * For record user name
     *
     * @var string
     *
     * @Column(type="string", length=50)
     */
    private $user;

    /**
     * For store content of message
     *
     * @var string
     *
     * @Column(type="string", length=500)
     */
    private $content;

    /**
     * For record the message leaving time
     *
     * @var DateTime
     *
     * @Column(type="datetime")
     */
    private $time;

    /**
     * normal construct
     *
     * @param Message
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
        $this->time = new \DateTime('now');
    }

    /**
     * return id of this object
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * return user name of this obj
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     *set the user name
     *
     * @param string
     * @return Reply
     */
    public function setUser($name)
    {
        $this->user = $name;
        return $this;
    }

    /**
     * return message content of this obj
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * set message content
     *
     * @param string
     * @return Reply
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * return message time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * return message_id
     *
     * @return integer
     */
    public function getMessage()
    {
        return $this->message;
    }


}

