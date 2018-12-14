<?php
class UserManager
{
    private $_bdd;

    public function __construct(PDO $bdd)
    {
        $this->setBdd($bdd);
    }

    public function getUsers(User $admin)
    {
        $query = $this->getBdd()->prepare('SELECT * FROM user WHERE pseudo = :pseudo');
        $query->bindValue(':pseudo', $admin->getPseudo(), PDO::PARAM_STR);
        $query->execute();
        $users = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($users as $user) {
            return new User($user);
        }
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
