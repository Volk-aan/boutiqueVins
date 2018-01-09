<?php

namespace CitadelleDuVin\DAO;

use CitadelleDuVin\Domain\User;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserDAO extends DAO implements UserProviderInterface
{

    /**
     * Returns a user matching the supplied id.
     *
     * @param integer $id The user id.
     *
     * @return \CitadelleDuVin\Domain\User|throws an exception if no matching user is found
     */
    public function find($id)
    {
        $sql = "select * from UTILISATEURS where ID_CLIENT=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new \Exception("No user matching id " . $id);
        }

    }

    /**
     * {@inheritDoc}
     */
    public function loadUserByUsername($username)
    {
        $sql = "select * from UTILISATEURS where EMAIL=?";
        $row = $this->getDb()->fetchAssoc($sql, array($username));

        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new UsernameNotFoundException(sprintf('User "%s" not found.', $username));
        }

    }

    /**
     * {@inheritDoc}
     */
    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
        }
        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        return 'CitadelleDuVin\Domain\User' === $class;
    }

        /**
     * Return a list of all products.
     *
     * @return array A list of all products.
     */

    public function findAll() {
        
        $sql = "select * from UTILISATEURS";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $users = array();
        foreach ($result as $row) {
            $userId = $row['ID_CLIENT'];
            $users[$userId] = $this->buildDomainObject($row);
        }
        return $users;
    }


    /**
     * Creates a User object based on a DB row.
     *
     * @param array $row The DB row containing User data.
     * @return \CitadelleDuVin\Domain\User
     */
    protected function buildDomainObject(array $row)
    {
        $user = new User();
        $user->setId($row['ID_CLIENT']);
        $user->setUsername($row['EMAIL']);
        $user->setPassword($row['MOT_DE_PASSE']);
        $user->setSalt($row['SALT']);
        $user->setRole($row['ROLE']);
        $user->setFirstname($row['PRENOM']);
        $user->setLastname($row['NOM']);
        $user->setStreet($row['RUE']);
        $user->setCity($row['LOCALITE']);
        $user->setPostalCode($row['CODE_POSTAL']);
        $user->setPhoneNumber($row['TELEPHONE']);

        return $user;
    }

    public function editUser(User $user) {
        $userData = array(
            'ID_CLIENT' => $user->getId(),
            'NOM' => $user->getLastname(),
            'PRENOM'=> $user->getFirstName(),
            'RUE' => $user->getStreet(),
            'CODE_POSTAL' => $user->getPostalCode(),
            'LOCALITE' => $user->getCity(),
            'TELEPHONE' => $user->getPhoneNumber(),
            'EMAIL' => $user->getEmail()
            );
            $this->getDb()->update('UTILISATEURS', $userData, array('ID_CLIENT' => $user->getId()));
    }

        /**
     * Saves a user into the database.
     *
     * @param \CitadelleDuVin\Domain\User $user The user to save
     */
    public function save(User $user) {
        $userData = array(
            'NOM' => strtoupper($user->getLastName()),
            'PRENOM' => strtoupper($user->getFirstName()),
            'RUE' => strtoupper($user->getStreet()),
            'CODE_POSTAL' => $user->getPostalCode(),
            'LOCALITE' => strtoupper($user->getCity()),
            'EMAIL' => strtoupper($user->getUsername()),
            'SALT' => $user->getSalt(),
            'MOT_DE_PASSE' => $user->getPassword(),
            'TELEPHONE' =>$user->getPhoneNumber(),
            'ROLE' => "ROLE_USER"
            );

        if ($user->getId()) {
            // The user has already been saved : update it
            $this->getDb()->update('UTILISATEURS', $userData, array('ID_CLIENT' => $user->getId()));
        } else {
            // The user has never been saved : insert it
            $this->getDb()->insert('UTILISATEURS', $userData);
            // Get the id of the newly created user and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $user->setId($id);
        }
    }

    /**
     * Removes a user from the database.
     *
     * @param @param integer $id The user id.
     */
    public function delete($id) {
        // Delete the user
        $this->getDb()->delete('UTILISATEURS', array('ID_CLIENT' => $id));
    }
}

