<?php

namespace ContatosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contatos
 *
 * @ORM\Table(name="contatos")
 * @ORM\Entity(repositoryClass="ContatosBundle\Repository\ContatosRepository")
 */
class Contatos
{
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Contatos
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     * @return Contatos
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return string
     */
    public function getTell()
    {
        return $this->tell;
    }

    /**
     * @param string $tell
     * @return Contatos
     */
    public function setTell($tell)
    {
        $this->tell = $tell;
        return $this;
    }

    /**
     * @return string
     */
    public function getCell()
    {
        return $this->cell;
    }

    /**
     * @param string $cell
     * @return Contatos
     */
    public function setCell($cell)
    {
        $this->cell = $cell;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Contatos
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * @param string $bairro
     * @return Contatos
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
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
     * @return Contatos
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }
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
     * @ORM\Column(name="nome", type="string", precision=0, scale=0, nullable=false, unique=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="tell", type="string", precision=0, scale=0, nullable=false, unique=false)
     */
    private $tell;

    /**
     * @var string
     *
     * @ORM\Column(name="cell", type="string", precision=0, scale=0, nullable=false, unique=false)
     */
    private $cell;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", precision=0, scale=0, nullable=false, unique=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="bairro", type="string", precision=0, scale=0, nullable=false, unique=false)
     */
    private $bairro;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=1, precision=0, scale=0, nullable=false, unique=false)
     */
    private $status;


}

