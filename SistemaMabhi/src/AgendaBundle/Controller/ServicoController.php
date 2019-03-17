<?php

namespace AgendaBundle\Controller;

use AgendaBundle\AgendaBundle;
use AgendaBundle\Entity\Agendados;
use AgendaBundle\Entity\Servicos;
use ContatosBundle\Entity\Contatos;
use DoctrineExtensions\Query\Mysql\Date;
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
                $lista[$i]['dtAtualizacao'] = $servico->getDataAtualizacao();
                $lista[$i]['Status'] = $servico->getStatus();
                $lista[$i]['posicao'] = $i;
                $i++;
            }
        }

        if($request->request){
            $salvar = $request->request->get('invisivel');
        }else{
            $salvar = '';
        }

        if($salvar != ''){

            $nome = $request->request->get('nome');
            $preco = $request->request->get('preco');

            $em = $this->getDoctrine()->getManager();
            $product = $em->getRepository('AgendaBundle\Entity\Servicos')->find($salvar);

            if (!$product) {
                throw $this->createNotFoundException(
                    'No product found for id '.$salvar
                );
            }
            if($servicos != null){
                foreach ($lista as $item){
                    $houvealteracao = false;
                    if($item['Nomeservico'] != $nome){
                        $product->setNomeservico($nome);
                        $houvealteracao = true;
                    }
                    if($item['Preco'] != $preco){
                        $product->setPreco($preco);
                        $houvealteracao = true;
                    }
                    if ($houvealteracao == true){
                        $product->setDataAtualizacao(new \DateTime());
                    }
                }
            }

            $em->flush();
            return $this->redirectToRoute('servicoListagem');
        }


        return $this->render('AgendaBundle:Servico:index.html.twig',
            array(
                'servicos' => $lista,
                'rota' => 'ativos',
                'mensagem' => $mensagem,
            )
        );
    }

    /**
     * @Route("/Servico/listagemDesativados", name="servicoListagemDesativados")
     */
    public function servicoListagemDesativadosAction(Request $request)
    {

        $servicos = $this->getDoctrine()
            ->getRepository(Servicos::class)
            ->findBy(array('status' => 0));

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
                $lista[$i]['dtAtualizacao'] = $servico->getDataAtualizacao();
                $lista[$i]['Status'] = $servico->getStatus();
                $lista[$i]['posicao'] = $i;
                $i++;
            }
        }

        if($request->request){
            $salvar = $request->request->get('invisivel');
        }else{
            $salvar = '';
        }

        if($salvar != ''){

            $nome = $request->request->get('nome');
            $preco = $request->request->get('preco');

            $em = $this->getDoctrine()->getManager();
            $product = $em->getRepository('AgendaBundle\Entity\Servicos')->find($salvar);

            if (!$product) {
                throw $this->createNotFoundException(
                    'No product found for id '.$salvar
                );
            }
            if($servicos != null){
                foreach ($lista as $item){
                    $houvealteracao = false;
                    if($item['Nomeservico'] != $nome){
                        $product->setNomeservico($nome);
                        $houvealteracao = true;
                    }
                    if($item['Preco'] != $preco){
                        $product->setPreco($preco);
                        $houvealteracao = true;
                    }
                    if ($houvealteracao == true){
                        $product->setDataAtualizacao(new \DateTime());
                    }
                }
            }

            $em->flush();
            return $this->redirectToRoute('servicoListagem');
        }


        return $this->render('AgendaBundle:Servico:index.html.twig',
            array(
                'servicos' => $lista,
                'rota' => 'desativados',
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

    /**
     * @Route("/Servico/desativar/{id}", name="servicoDesativar")
     */
    public function servicoDesativarAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AgendaBundle\Entity\Servicos')->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $product->setStatus("0");
        $em->flush();

        return $this->redirectToRoute('servicoListagem');
    }
    /**
     * @Route("/Servico/ativar/{id}", name="servicoAtivar")
     */
    public function servicoAtivarAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AgendaBundle\Entity\Servicos')->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $product->setStatus("1");
        $em->flush();

        return $this->redirectToRoute('servicoListagemDesativados');
    }

}
