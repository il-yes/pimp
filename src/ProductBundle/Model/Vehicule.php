<?php
/**
 * Created by PhpStorm.
 * User: versus
 * Date: 24/01/18
 * Time: 13:07
 */

namespace ProductBundle\Model;

use Doctrine\ORM\Mapping as ORM;


/**
 * This class represents a LabLog item, either a BlogPost or an Event.
 * It is abstract because we never have a LabLog entity, it's either an event or a blog post.
 * @ORMEntity
 * @ORMTable(name="prod_vehicule")
 * @ORMInheritanceType("JOINED")
 * @ORMDiscriminatorColumn(name="type", type="string")
 * @ORMDiscriminatorMap( {"moto" = "Moto", "auto" = "Auto", "truck", "Truck"} )
 */
abstract class Vehicule
{
    const AUTO = 'automobile';
    const MOTO = 'motorcycle';
    const TRUCK = 'poids_lourd';

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=100)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=100, nullable=true)
     */
    private $state;



    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

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

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param $state
     * @return $this
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }



}