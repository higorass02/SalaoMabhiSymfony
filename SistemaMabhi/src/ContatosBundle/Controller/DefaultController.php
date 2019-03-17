<?php

namespace ContatosBundle\Controller;

use ContatosBundle\ContatosBundle;
use ContatosBundle\Entity\Contatos;
use ContatosBundle\Repository\ContatosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AgendaBundle\Repository\AgendadosRepository;
use Symfony\Component\HttpFoundation\JsonResponse;


class DefaultController extends Controller
{
    /**
     * @Route("/Contatos/listagem", name="contatosListagem")
     */
    public function contatosListagemAction()
    {

        $contatos=$this->getDoctrine()
            ->getRepository('ContatosBundle\Entity\Contatos')
            ->findBy(array('status' => 1));

        $i = 0;
        $lista = array();
        foreach($contatos as $contato)
        {
            $lista[$i]['id'] = $contato->getId();
            $lista[$i]['nome'] = $contato->getNome();
            $lista[$i]['tell'] = $contato->getTell();
            $lista[$i]['cell'] = $contato->getCell();
            $lista[$i]['email'] = $contato->getEmail();
            $lista[$i]['bairro'] = $contato->getBairro();
            $lista[$i]['status'] = $contato->getStatus();
            $lista[$i]['posicao'] = $i;
            $i++;
        }

        return $this->render('ContatosBundle:Default:listagem.html.twig',
            array(
                'contatos' => $lista,
                'rota' => 'ativos',
                'totContatos' => $i
            )
        );
    }
    /**
     * @Route("/Contatos/listagemDesativados", name="contatosListagemDesativados")
     */
    public function contatosListagemDesativadosAction(Request $request)
    {

        $contatos=$this->getDoctrine()
            ->getRepository('ContatosBundle\Entity\Contatos')
            ->findBy(array('status' => 0));

        $i = 0;
        $lista = array();
        foreach($contatos as $contato)
        {
            $lista[$i]['id'] = $contato->getId();
            $lista[$i]['nome'] = $contato->getNome();
            $lista[$i]['tell'] = $contato->getTell();
            $lista[$i]['cell'] = $contato->getCell();
            $lista[$i]['email'] = $contato->getEmail();
            $lista[$i]['bairro'] = $contato->getBairro();
            $lista[$i]['status'] = $contato->getStatus();
            $lista[$i]['posicao'] = $i;
            $i++;
        }

        return $this->render('ContatosBundle:Default:listagem.html.twig',
            array(
                'contatos' => $lista,
                'rota' => 'desativado',
                'totContatos' => $i
            )
        );
    }

    /**
     * @Route("/Contatos/novo", name="contatosNovo")
     */
    public function contatosNovoAction(Request $request)
    {
        var_dump($request->request);


        //if($request->request->all()){
            //var_dump($request->request->all());

            $nome = $request->request->get('nome');
            $tell = $request->request->get('tell');
            $cell = $request->request->get('cell');
            $email = $request->request->get('email');
            $bairro = $request->request->get('bairro');

            $em = $this->getDoctrine()->getManager();

            $contato = new Contatos();
            $contato->setNome($nome);
            $contato->setTell($tell);
            $contato->setCell($cell);
            $contato->setEmail($email);
            $contato->setBairro($bairro);
            $contato->setStatus(1);

            $em->persist($contato);
            $em->flush();
        //}

        $i = 0;
        $lista[$i]['id'] = '';
        $lista[$i]['nome'] = '';
        $lista[$i]['tell'] = '';
        $lista[$i]['cell'] = '';
        $lista[$i]['email'] = '';
        $lista[$i]['bairro'] = '';

        return $this->redirectToRoute('contatosListagem');
        //return $this->render('ContatosBundle:Default:formulario.html.twig', array('contatos' => $lista,) );
    }

    /**
     * @Route("/Contatos/alterar", name="contatosAlterar")
     */
    public function contatosAlterarAction(Request $request)
    {
        if(!$request->request->get('id')){
            return $this->redirectToRoute('contatosListagem');
        }else{

            $id = $request->request->get('id');

            $em = $this->getDoctrine()->getManager();
            $product = $em->getRepository('ContatosBundle\Entity\Contatos')->find($id);

            if (!$product) {
                throw $this->createNotFoundException(
                    'No product found for id '.$id
                );
            }

            $product->setNome($request->request->get('nome'));
            $product->setTell($request->request->get('tell'));
            $product->setCell($request->request->get('cell'));
            $product->setEmail($request->request->get('email'));
            $product->setBairro($request->request->get('bairro'));

            $em->flush();
            if($request->request->get('rota') == "ativos")
                return $this->redirectToRoute('contatosListagem');
            else
                return $this->redirectToRoute('contatosListagemDesativados');
        }


    }

    /**
     * @Route("/Contatos/desativar/{id}", name="contatosDesativar")
     */
    public function contatosDesativarAction(Request $request, $id)
    {
            $em = $this->getDoctrine()->getManager();
            $product = $em->getRepository('ContatosBundle\Entity\Contatos')->find($id);

            if (!$product) {
                throw $this->createNotFoundException(
                    'No product found for id '.$id
                );
            }

            $product->setStatus("0");
            $em->flush();

            return $this->redirectToRoute('contatosListagem');
    }

    /**
     * @Route("/Contatos/ativar/{id}", name="contatosAtivar")
     */
    public function contatosAtivarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('ContatosBundle\Entity\Contatos')->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $product->setStatus("1");
        $em->flush();

        return $this->redirectToRoute('contatosListagem');
    }
    /**
     * @Route("/Contatos/autocomplete", name="autocompleteContatos")
     */
    public function autocompleteContatosAction(Request $request)
    {
        $names = array();
        $term = trim(strip_tags($request->get('term')));
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ContatosBundle:Contatos')->createQueryBuilder('c')
            ->where('c.nome LIKE :nome')
            ->setParameter('nome', '%' . $term . '%')
            ->getQuery()
            ->getResult();

        foreach ($entities as $entity) {
            $names[] = $entity->getNome();
        }

        $response = new JsonResponse();
        $response->setData($names);

        return $response;

    }
}
