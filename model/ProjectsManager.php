<?php
class ProjectsManager
{
    private $_bdd;

    public function __construct(PDO $bdd)
    {
        $this->setBdd($bdd);
    }

    public function getProjects()
    {
        $arrayOfProject = [];
        $query = $this->getBdd()->query('SELECT * FROM projects');
        $query->execute();
        $projects = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($projects as $project) {
            $arrayOfProject[] = new Projects($project);
        }

        return $arrayOfProject;
    }

    public function addUser(User $user)
    {
        $query = $this->getBdd()->prepare('INSERT INTO user(pseudo) VALUES(:pseudo)');
        $query->bindValue(':pseudo', $user->getPseudo(), PDO::PARAM_STR);
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
