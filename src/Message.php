<?php

/**
 * @Entity
 * @Table(name="message1")
 */
class Message {

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @Column(type="string", length=50)
     */
    protected $user;

    /**
     * @Column(type="string", length=500)
     */
    protected $content;

    /**
     * @Column(type="datetime")
     */
    protected $time;

    public function __construct(\DateTime $createDate) {
        $this->time = $createDate;
    }

    public function getId() {
        return $this->id;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser($name) {
        $this->user = $name;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function getTime() {
        return $this->time->format('Y-m-d H:i:s');
    }

}
