<?php

/**
 * @Entity
 * @Table(name="message")
 */
class Message
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
     * @var \DateTime
     *
     * @Column(type="datetime")
     */
    private $time;

    /**
     *紀錄在這個留言下的回覆
     *
     * @var Doctrine\Common\Collections\ArrayCollection
     *
     * @OneToMany(targetEntity="Reply", mappedBy="message")
     */
    private $replyies;

    /**
     * normal construct
     */
    public function __construct()
    {
        $this->time = new \DateTime('now');
        $this->replyies = new Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     *return this message's replys
     *
     * @return Doctrine\Common\Collections\ArrayCollection
     */
    public function getReplies()
    {
        return $this->replyies;
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
     * @return Message
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
     * @return Message
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * return message time
     *
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }
}
