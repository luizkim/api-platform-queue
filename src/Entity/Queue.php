<?php

namespace ControleOnline\Entity;



use Doctrine\ORM\Mapping as ORM;



use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;


/**
 * @ORM\EntityListeners({ControleOnline\Listener\LogListener::class})
 * @ApiResource(
 *     attributes={
 *          "formats"={"jsonld", "json", "html", "jsonhal", "csv"={"text/csv"}},
 *          "access_control"="is_granted('ROLE_CLIENT')"
 *     }, 
 *     normalizationContext  ={"groups"={"queue:read"}},
 *     denormalizationContext={"groups"={"queue:write"}},
 *     attributes            ={"access_control"="is_granted('ROLE_CLIENT')"},
 *     collectionOperations  ={
 *          "get"              ={
 *            "access_control"="is_granted('ROLE_CLIENT')", 
 *          },
 *     },
 *     itemOperations        ={
 *         "get"           ={
 *           "access_control"="is_granted('ROLE_CLIENT')", 
 *         },
 *         "put"           ={
 *           "access_control"="is_granted('ROLE_CLIENT')",  
 *         },
 *         "delete"           ={
 *           "access_control"="is_granted('ROLE_CLIENT')",  
 *         }, 
 *     }
 * )
 * @ORM\Table(name="queue", uniqueConstraints={@ORM\UniqueConstraint(name="queue", columns={"queue", "company_id"})}, indexes={@ORM\Index(name="company_id", columns={"company_id"})})
 * @ORM\Entity
 */


class Queue
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups({"order:read","order_details:read","order:write","queue:read", "queue:write"})   
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="queue", type="string", length=50, nullable=false)
     * @Groups({"order:read","order_details:read","order:write","queue:read", "queue:write"})   
     */
    private $queue;

    /**
     * @var \People
     *
     * @ORM\ManyToOne(targetEntity="People")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     * })
     * @Groups({"order:read","order_details:read","order:write","queue:read", "queue:write"})   
     */
    private $company;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="ControleOnline\Entity\OrderQueue", mappedBy="queue")
     */
    private $orderQueue;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="ControleOnline\Entity\DisplayQueue", mappedBy="queue")     
     */
    private $displayQueue;


    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of queue
     */
    public function getQueue()
    {
        return $this->queue;
    }

    /**
     * Set the value of queue
     */
    public function setQueue($queue): self
    {
        $this->queue = $queue;

        return $this;
    }

    /**
     * Get the value of company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set the value of company
     */
    public function setCompany($company): self
    {
        $this->company = $company;

        return $this;
    }



    /**
     * Add OrderQueue
     *
     * @param \ControleOnline\Entity\OrderQueue $invoice_tax
     * @return Order
     */
    public function addAOrderQueue(\ControleOnline\Entity\OrderQueue $orderQueue)
    {
        $this->orderQueue[] = $orderQueue;

        return $this;
    }

    /**
     * Remove OrderQueue
     *
     * @param \ControleOnline\Entity\OrderQueue $invoice_tax
     */
    public function removeOrderQueue(\ControleOnline\Entity\OrderQueue $orderQueue)
    {
        $this->orderQueue->removeElement($orderQueue);
    }

    /**
     * Get OrderQueue
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrderQueue()
    {
        return $this->orderQueue;
    }


    /**
     * Add DisplayQueue
     *
     * @param \ControleOnline\Entity\DisplayQueue $invoice_tax
     * @return Order
     */
    public function addADisplayQueue(\ControleOnline\Entity\DisplayQueue $displayQueue)
    {
        $this->displayQueue[] = $displayQueue;

        return $this;
    }

    /**
     * Remove DisplayQueue
     *
     * @param \ControleOnline\Entity\DisplayQueue $invoice_tax
     */
    public function removeDisplayQueue(\ControleOnline\Entity\DisplayQueue $displayQueue)
    {
        $this->displayQueue->removeElement($displayQueue);
    }

    /**
     * Get DisplayQueue
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDisplayQueue()
    {
        return $this->displayQueue;
    }
}
