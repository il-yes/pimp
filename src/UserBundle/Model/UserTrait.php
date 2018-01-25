<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 24/01/18
 * Time: 17:51
 */

namespace UserBundle\Model;


trait UserTrait
{
    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=100)
     */
    private $type;

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }



}