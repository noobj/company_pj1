<?php

/**
 * @Entity
 * @Table(name="message")
 */
class Message
{
    /**
     * TABLE的ID
     * @var integer
     *
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * For record user name
     * @var string
     *
     * @Column(type="string", length=50)
     */
    protected $user;

    /**
     * For store content of message
     *
     * @var string
     *
     * @Column(type="string", length=500)
     */
    protected $content;

    /**
     * For record the message leaving time
     *
     * @var string
     *
     * @Column(type="datetime")
     */
    protected $time;

    public function __construct(\DateTime $createDate)
    {
        $this->time = $createDate;
    }

    /*
     * return id of this object
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /*
     * return user name of this obj
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /*
     *set the user name
     *
     * @param string
     *
     * @return void
     */
    public function setUser($name)
    {
        $this->user = $name;
    }

    /*
     * return message content of this obj
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /*
     * set message content
     *
     * @param string
     *
     * @return void
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /*
     * return message time
     *
     * @return string
     */
    public function getTime()
    {
        return $this->time->format('Y-m-d H:i:s');
    }
}
