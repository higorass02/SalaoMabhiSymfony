<?php

namespace AgendaBundle\Controller;

use AgendaBundle\Entity\Agendados;
use AgendaBundle\Entity\Servicos;
use ContatosBundle\Entity\Contatos;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use AgendaBundle\Repository\AgendadosRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/Agenda", name="agenda")
     */
    public function agendaAction()
    {
        $lista ="";
        $mensagem ="";
        $listagem = "";
        $semrota = 1;

        return $this->render('AgendaBundle:Default:index.html.twig',
            array(
                'agendados' => $lista,
                'mensagem' => $mensagem,
                'listagem' => $listagem,
                'semrota' => $semrota,
            )
        );
    }
    /**
     * @Route("/Agenda/{dia}/{mes}/{ano}", name="agendado")
     */
    public function agendadoAction($dia,$mes,$ano)
    {
//       $data = \DateTime::createFromFormat('yyyy-M-D', '2019-02-03')->format('');
//        $data =( new \DateTime("2019-02-03 00:00:00"))->format("Y-m-d H:i:s") . PHP_EOL;

        $agendados = $this->getDoctrine()
            ->getRepository(Agendados::class)
            ->findAllOrderedByName($dia,$mes,$ano);
//        var_dump($agendados);exit();
        if($agendados == null){
            $mensagem = "Ninguem Marcado!!";
            $lista = '';
        }else {
//        var_dump($agendados);
            $i = 0;

            foreach ($agendados as $agendado) {
                $lista[$i]['id'] = $agendado->getId();

                $contatos = $this->getDoctrine()
                    ->getRepository(Contatos::class)
                    ->find($agendado->getIdCliente());

                $lista[$i]['idCliente'] = $contatos->getNome();
                $lista[$i]['data_agendado'] = $agendado->getDataAgendado();
                $lista[$i]['data_criacao'] = $agendado->getDataCriacao();

                $servicos = $this->getDoctrine()
                    ->getRepository('AgendaBundle\Entity\Servicos')
                    ->find($agendado->getServico());

                $lista[$i]['servico'] = $servicos->getNomeservico().' - '.$servicos->getPreco();
                $lista[$i]['hora'] = $agendado->getHora();
                $lista[$i]['status'] = $agendado->getStatus();
                $i++;
            }
            $mensagem = "";
        }

        $servicoslista = $this->getDoctrine()
            ->getRepository('AgendaBundle\Entity\Servicos')
            ->findAll();

        $j=0;
        foreach ($servicoslista as $servicoss){
            $listagem[$j]['id'] = $servicoss->getId();
            $listagem[$j]['nome'] = $servicoss->getNomeservico();
            $listagem[$j]['preco'] = $servicoss->getPreco();
            $j++;
        }

        $semrota = 0;
//        var_dump($lista).exit();
        return $this->render('AgendaBundle:Default:index.html.twig',
            array(
                'agendados' => $lista,
                'mensagem' => $mensagem,
                'listagem' => $listagem,
                'semrota' => $semrota,
            )
        );
    }

    /**
     * @Route("/Agenda/{dia}/{mes}/{ano}/cadastrar", name="cadastrarAgendamento")
     */
    public function cadastrarAgendamentoAction($dia,$mes,$ano,Request $request)
    {
        if($request->request->all()){

            $nome = $request->request->get('nome');
            $horario = $request->request->get('horario');
            $servicoop = $request->request->get('servico');
            $em = $this->getDoctrine()->getManager();

            $data = date("m/d/y", strtotime("$ano-$mes-$dia"));

            $contato = new Agendados();

            $contatos = $this->getDoctrine()
                ->getRepository(Contatos::class)
                ->find(1);
//            var_dump($contatos->getId());exit();
            $contato->setIdCliente($contatos);
            $contato->setHora($horario);
            $servico = $this->getDoctrine()
                ->getRepository(Servicos::class)
                ->find($servicoop);
            $contato->setServico($servico);
            $contato->setDataCriacao(new \DateTime());
            $contato->setDataAgendado(new \DateTime($data));
            $contato->setStatus(1);

            $em->persist($contato);
            $em->flush();

        }
        return $this->redirect('http://127.0.0.1:8000/Agenda/'.$dia.'/'.$mes.'/'.$ano);
    }
    /**
     * @Route("/Agenda/{dia}/{mes}/{ano}/desativar/{id}", name="desativarAgendamento")
     */
    public function desativarAgendamentoAction($dia,$mes,$ano,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $agendado = $em->getRepository('AgendaBundle\Entity\Agendados')->find($id);

        if (!$agendado) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $agendado->setStatus("0");
        $em->flush();
        return $this->redirect('http://127.0.0.1:8000/Agenda/'.$dia.'/'.$mes.'/'.$ano);
    }
}
