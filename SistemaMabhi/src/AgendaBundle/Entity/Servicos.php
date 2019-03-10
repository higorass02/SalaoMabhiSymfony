<?php

namespace AgendaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Servicos
 *
 * @ORM\Table(name="servicos")
 * @ORM\Entity(repositoryClass="AgendaBundle\Repository\AgendadosRepository")
 */
class Servicos
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
     * @var string
     *
     * @ORM\Column(name="nomeServico", type="string", precision=0, scale=0, nullable=false, unique=false)
     */
    private $nomeservico;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=1, precision=0, scale=0, nullable=false, unique=false)
     */
    private $status;

    /**
     * @var float
     *
     * @ORM\Column(name="preco", type="float", length=1, precision=0, scale=0, nullable=false, unique=false)
     */
    private $preco;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_criacao", type="date", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data_criacao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_atualizacao", type="date", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data_atualizacao;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Servicos
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNomeservico()
    {
        return $this->nomeservico;
    }

    /**
     * @param string $nomeservico
     * @return Servicos
     */
    public function setNomeservico($nomeservico)
    {
        $this->nomeservico = $nomeservico;
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
     * @return Servicos
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return float
     */
    public function getPreco()
    {
        return $this->preco;
    }

    /**
     * @param float $preco
     * @return Servicos
     */
    public function setPreco($preco)
    {
        $this->preco = $preco;
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
     * @return Servicos
     */
    public function setDataCriacao($data_criacao)
    {
        $this->data_criacao = $data_criacao;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDataAtualizacao()
    {
        return $this->data_atualizacao;
    }

    /**
     * @param \DateTime $data_atualizacao
     * @return Servicos
     */
    public function setDataAtualizacao($data_atualizacao)
    {
        $this->data_atualizacao = $data_atualizacao;
        return $this;
    }

}

