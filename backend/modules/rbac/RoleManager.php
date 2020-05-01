<?php

namespace backend\modules\rbac;


use backend\modules\rbac\forms\RoleEditForm;
use yii\rbac\ManagerInterface;


/**
 * Class RoleManager
 * @package shop\services
 */
class RoleManager
{

    /**
     * @var ManagerInterface
     */
    private $manager;


    /**
     * RoleManager constructor.
     * @param ManagerInterface $manager
     */
    public function __construct(ManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * {@inheritdoc}
     */

    public function assign($userId, $name)
    {

        $am = $this->manager;

        if (!$role = $am->getRole($name)) {

            throw new \DomainException('Role "' . $name . '" does not exist.');
        }
        $am->revokeAll($userId);
        $am->assign($role, $userId);
    }


    /**
     * @param $name
     */
    public function createRole($name, $description)
    {

        if ($name === $this->manager->getRole($name)) {

            throw new \DomainException('Role  уже существует.');

        }

        $newRole = $this->manager->createRole($name);
        $newRole->description = $description;
        $this->manager->add($newRole);

    }

    /**
     * @param $permission
     * @param $description
     */
    public function createPermission($permission, $description)
    {

        if ($permission == $this->manager->getPermission($permission)) {

            throw new \DomainException('Permission уже существует.');

        }

        $newPermission = $this->manager->createPermission($permission);
        $newPermission->description = $description;
        $this->manager->add($newPermission);

    }

    /**
     * @param $parent
     * @param $child
     */
    public function createItemChildren($parent, $child)
    {


        $parent = $this->manager->createRole($parent);
        $child = $this->manager->createRole($child);

        if ($this->manager->canAddChild($parent, $child)) {


            $this->manager->addChild($parent, $child);
        } else {

            throw new \DomainException('Невозможно добавить иерархию');
        }


    }


    public function createAuthAssignment($roleForm, $userId)
    {


        if (!$role = $this->manager->createRole($roleForm)) {

            throw new \DomainException('Role "' . $roleForm . '" does not exist.');
        }

        $this->manager->revokeAll($userId);
        $this->manager->assign($role, $userId);


    }

    /**
     * @param $name
     */
    public function deleteRoleOrPermission($name)
    {

        $role = $this->manager->createRole($name);


        if (!$this->manager->remove($role)) {
            throw new \RuntimeException('Removing error.');
        }


    }

    /**
     * @param RoleEditForm $form
     * @param $oldName
     * @return \yii\rbac\Role
     */
    public function updateRoleOrPermission(RoleEditForm $form, $oldName)
    {

        if ($form->name === $this->manager->getRole($form->name)) {

            throw new \DomainException('Role "' . $form->name . '" уже существует.');

        }

        $newRole = $this->manager->createRole($form->name);
        $newRole->description = $form->description;
        $this->manager->update($oldName, $newRole);

        return $newRole;

    }

    /**
     * @param $parent
     * @param $child
     */
    public function deleteItemChildren($parent, $child)
    {

        $parent = $this->manager->createRole($parent);
        $child = $this->manager->createRole($child);

        if (!$this->manager->removeChild($parent, $child)) {
            throw new \RuntimeException('Removing error.');
        }


    }


    /**
     * @param $item_name
     * @param $userId
     */

    public function deleteAuthAssignment($item_name, $userId)
    {
        $role = $this->manager->createRole($item_name);

       if( !$this->manager->revoke($role, $userId)){

           throw new \RuntimeException('Removing error.');
       }

    }

}