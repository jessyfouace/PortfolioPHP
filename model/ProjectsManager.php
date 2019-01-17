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
        $query = $this->getBdd()->query('SELECT * FROM projects ORDER BY id DESC LIMIT 3');
        $query->execute();
        $projects = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($projects as $project) {
            $arrayOfProject[] = new Projects($project);
        }

        return $arrayOfProject;
    }

    public function getAllProjects()
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

    public function getProjectsById(Projects $project)
    {
        $arrayOfProject;
        $query = $this->getBdd()->prepare('SELECT * FROM projects WHERE id = :id');
        $query->bindValue(':id', $project->getId(), PDO::PARAM_INT);
        $query->execute();
        $projects = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($projects as $project) {
            $arrayOfProject = new Projects($project);
        }

        return $arrayOfProject;
    }

    public function updateProject(Projects $project)
    {
        $query = $this->_bdd->prepare('UPDATE projects SET title = :title, description = :description, link = :link, image = :image WHERE id = :id');
        $query->bindValue(':id', $project->getId(), PDO::PARAM_INT);
        $query->bindValue(':title', $project->getTitle(), PDO::PARAM_STR);
        $query->bindValue(':description', $project->getDescription(), PDO::PARAM_STR);
        $query->bindValue(':link', $project->getLink(), PDO::PARAM_STR);
        $query->bindValue(':image', $project->getImage(), PDO::PARAM_STR);
        $query->execute();
    }

    public function addProject(Projects $project)
    {
        $query = $this->getBdd()->prepare('INSERT INTO projects(title, description, link, image) VALUES(:title, :description, :link, :image)');
        $query->bindValue(':title', $project->getTitle(), PDO::PARAM_STR);
        $query->bindValue(':description', $project->getDescription(), PDO::PARAM_STR);
        $query->bindValue(':link', $project->getLink(), PDO::PARAM_STR);
        $query->bindValue(':image', $project->getImage(), PDO::PARAM_STR);
        $query->execute();
    }

    public function removeProject(Projects $project)
    {
        $query = $this->getBdd()->prepare('DELETE FROM projects WHERE id = :id');
        $query->bindValue('id', $project->getId(), PDO::PARAM_INT);
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
