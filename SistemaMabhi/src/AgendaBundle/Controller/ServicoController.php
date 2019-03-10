<?php

namespace AgendaBundle\Controller;

use AgendaBundle\AgendaBundle;
use AgendaBundle\Entity\Agendados;
use AgendaBundle\Entity\Servicos;
use ContatosBundle\Entity\Contatos;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use AgendaBundle\Repository\AgendadosRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ServicoController extends Controller
{
    /**
     * @Route("/Servico", name="servico")
     */
    public function servicoAction()
    {
        return $this->redirectToRoute('servicoListagem');
    }

    /**
     * @Route("/Servico/listagem", name="servicoListagem")
     */
    public function servicoListagemAction(Request $request)
    {
        $servicos = $this->getDoctrine()
            ->getRepository(Servicos::class)
            ->findBy(array('status' => 1));

        if($servicos == null){
            $mensagem = "Nenhum servico cadastrado!!";
            $lista = '';
        }else {
            $mensagem = "";
            $i = 0;
            foreach($servicos as $servico)
            {
                $lista[$i]['id'] = $servico->getId();
                $lista[$i]['Nomeservico'] = $servico->getNomeservico();
                $lista[$i]['Preco'] = $servico->getPreco();
//                $lista[$i]['dtCriacao'] = $servico->getDataCriacao();
                $lista[$i]['dtAtualizacao'] = $servico->getDataAtualizacao();
                $lista[$i]['Status'] = $servico->getStatus();
                $i++;
            }
        }


        return $this->render('AgendaBundle:Servico:index.html.twig',
            array(
                'servicos' => $lista,
                'mensagem' => $mensagem,
            )
        );
    }

    /**
     * @Route("/Servico/novo", name="servicoNovo")
     */
    public function servicoNovoAction(Request $request)
    {
        date_default_timezone_set('America/Bahia');
        if($request->request->all()){
            //var_dump($request->request->all());

            $nome = $request->request->get('nome');
            $preco = $request->request->get('preco');

            $em = $this->getDoctrine()->getManager();

            $contato = new Servicos();
            $contato->setNomeservico($nome);
            $contato->setPreco($preco);
            $contato->setDataCriacao(new \DateTime());
            $contato->setDataAtualizacao(new \Datetime());
            $contato->setStatus(1);

            $em->persist($contato);
            $em->flush();
        }
        return $this->redirectToRoute('servicoListagem');

    }

    /**
     * @Route("/Servico/editar/{id}", name="servicoEditar")
     */
    public function servicoEditarAction(Request $request,$id)
    {
        $servico=$this->getDoctrine()
            ->getRepository('AgendaBundle\Entity\Servicos')
            ->find($id);
        $i = 0;

        $lista[$i]['id'] = $servico->getId();
        $lista[$i]['nome'] = $servico->getNomeservico();
        $lista[$i]['preco'] = $servico->getPreco();
        $lista[$i]['dtAlteracao'] = $servico->getDataAtualizacao();
        $lista[$i]['status'] = $servico->getStatus();

        return $this->render('AgendaBundle:Servico:formulario.html.twig',
            array(
                'servicos' => $lista,
            )
        );
    }

}
