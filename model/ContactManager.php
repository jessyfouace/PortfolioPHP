<?php
class ContactManager
{
    private $_bdd;

    public function __construct(PDO $bdd)
    {
        $this->setBdd($bdd);
    }

    public function getMessages()
    {
        $arrayOfMessages = [];
        $query = $this->getBdd()->query('SELECT * FROM contact');
        $query->execute();
        $messages = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($messages as $message) {
            $arrayOfMessages[] = new Contact($message);
        }

        return $arrayOfMessages;
    }

    public function getMessageById(Contact $message)
    {
        $arrayOfMessages;
        $query = $this->getBdd()->prepare('SELECT * FROM contact WHERE id = :id');
        $query->bindValue('id', $message->getId(), PDO::PARAM_INT);
        $query->execute();
        $messages = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($messages as $message) {
            $arrayOfMessages[] = new Contact($message);
        }

        return $arrayOfMessages;
    }

    public function removeMessage(Contact $message)
    {
        $query = $this->getBdd()->prepare('DELETE FROM contact WHERE id = :id');
        $query->bindValue('id', $message->getId(), PDO::PARAM_INT);
        $query->execute();
    }

    public function addMessage(Contact $message)
    {
        $query = $this->getBdd()->prepare('INSERT INTO contact(firstname, lastname, phone, email, message) VALUES(:firstname, :lastname, :phone, :email, :message)');
        $query->bindValue(':firstname', $message->getFirstname(), PDO::PARAM_STR);
        $query->bindValue(':lastname', $message->getLastname(), PDO::PARAM_STR);
        $query->bindValue(':phone', $message->getPhone(), PDO::PARAM_INT);
        $query->bindValue(':email', $message->getEmail(), PDO::PARAM_STR);
        $query->bindValue(':message', $message->getMessage(), PDO::PARAM_STR);
        $query->execute();
    }

    /**
     * Get the value of _bdd
     */
    public function getBdd()
    {
        return $this->_bdd;
    }

    /**
     * Set the value of _bdd
     *
     * @return  self
     */
    public function setBdd(PDO $bdd)
    {
        $this->_bdd = $bdd;

        return $this;
    }
}
