<?php

namespace AgendaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agendados
 *
 * @ORM\Table(name="agendados")
 * @ORM\Entity(repositoryClass="AgendaBundle\Repository\AgendadosRepository")
 */
class Agendados
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="ContatosBundle\Entity\Contatos")
     * @ORM\JoinColumn(name="id_contatos", referencedColumnName="id")
     *
     */
    private $idCliente;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_agendado", type="date", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data_agendado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_criacao", type="date", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data_criacao;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Servicos")
     * @ORM\JoinColumn(name="id_servico", referencedColumnName="id")
     */
    private $servico;

    /**
     * @var string
     *
     * @ORM\Column(name="hora", type="string", precision=0, scale=0, nullable=false, unique=false)
     */
    private $hora;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=1, precision=0, scale=0, nullable=false, unique=false)
     */
    private $status;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Agendados
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdCliente()
    {
        return $this->idCliente;
    }

    /**
     * @param int $idCliente
     * @return Agendados
     */
    public function setIdCliente($idCliente)
    {
        $this->idCliente = $idCliente;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDataAgendado()
    {
        return $this->data_agendado;
    }

    /**
     * @param \DateTime $data_agendado
     * @return Agendados
     */
    public function setDataAgendado($data_agendado)
    {
        $this->data_agendado = $data_agendado;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDataCriacao()
    {
        return $this->data_criacao;
    }

    /**
     * @param \DateTime $data_criacao
     * @return Agendados
     */
    public function setDataCriacao($data_criacao)
    {
        $this->data_criacao = $data_criacao;
        return $this;
    }

    /**
     * @return int
     */
    public function getServico()
    {
        return $this->servico;
    }

    /**
     * @param int $servico
     * @return Agendados
     */
    public function setServico($servico)
    {
        $this->servico = $servico;
        return $this;
    }

    /**
     * @return string
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * @param string $hora
     * @return Agendados
     */
    public function setHora($hora)
    {
        $this->hora = $hora;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Agendados
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

}

