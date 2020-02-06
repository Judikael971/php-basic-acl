<?php
namespace ACL;
class ACL
{
    protected $acl = array();
    protected $resources = array();

    public function __construct(){}

    public function addRole($role)
    {
        $this->acl[$role]=array();
    }

    public function addResource($resource, $actions ='*')
    {
        if(is_array($actions))
        {
            foreach ($actions as $action)
            {
                $this->resources[$resource][$action] = true;
            }
        }
        elseif (!empty($actions))
        {
            $this->resources[$resource][$actions] = true;
        }
        else
        {
            $this->resources[$resource]['*'] = true;
        }
    }

    public function allow($role, $resource, $actions='*')
    {
        $this->setAccesControl($role, $resource, $actions, true);
    }

    public function deny($role, $resource, $actions='*')
    {
        $this->setAccesControl($role, $resource, $actions);
    }

    public function isAllowed($role, $resource, $action='*')
    {
        if(array_key_exists($role, $this->acl))
        {
            if(array_key_exists($resource, $this->acl[$role]))
            {
                if(!empty($action) && array_key_exists($action, $this->acl[$role][$resource]))
                {
                    return $this->acl[$role][$resource][$action];
                }
                else
                {
                    return $this->acl[$role][$resource]['*'];
                }
            }
        }
        return false;
    }

    private function setAccesControl($role, $resource, $actions='*', $access=false)
    {
        if(array_key_exists($role, $this->acl)  && array_key_exists($resource, $this->resources))
        {
            if(!array_key_exists($resource, $this->acl[$role]))
            {
                $this->acl[$role][$resource]['*'] = false;
            }
            if(empty($actions) || $actions == '*')
            {
                foreach ($this->resources[$resource] as $resource_action => $action)
                {
                    $this->acl[$role][$resource][$resource_action] = $access;
                }
            }
            elseif(!empty($actions) && is_array($actions))
            {
                foreach ($actions as $action)
                {
                    $this->acl[$role][$resource][$action] = $access;
                }
            }
            elseif(!empty($actions) && array_key_exists($actions, $this->resources[$resource]))
            {
                $this->acl[$role][$resource][$actions] = $access;
            }
        }
    }
}
