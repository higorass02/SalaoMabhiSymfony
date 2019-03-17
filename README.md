<h1>Seja Bem Vindo</h1>
    <h3>SalaoMabhiSymfony</h3>
    Um sistema feito para auxiliar e agilizar servicos de salão de beleza.

<br>
<br>    
Instalacao
<br>
<br>
    
    [rodar local]
        --ingredientes
            ingre
            *xampp
            *composer
            *força de vontade
--instalacao
<br>

        Apos clonar para sua maquina,
         voce deve rodar o composer para baixar e instalar as dependencias do projeto.
         
         obs: para rodar o composer voce deve seguir os seguintes procedimentos
            1) abrir o xampp
            2) abrir o shell do xampp
            3) entrar na pasta do projeto
            4) rodar composer install.
            
        logo após terminar de rodar o composer 
         voce deve criar um banco com o nome preferencialmente como algo relacionado com o projeto(slmabhiprod)
        logo em seguida
         voce deve rodar o seguinte comando:
            php bin/console doctrine:schema:update --force --complete --dump-sql
            
            obs: para rodar o comando voce deve seguir os seguintes procedimentos
                                      1) abrir o xampp.
                                      2) abrir o shell do xampp.
                                      3) entrar na pasta do projeto.
                                      4) rodar o comando.
                        
         esse comando vai criar as tabelas necessarias pro sistema rodar

--Rodar o projeto
<br>


          obs: para rodar o comando voce deve seguir os seguintes procedimentos
              1) abrir o xampp.
              2) abrir o shell do xampp.
              3) entrar na pasta do projeto.
              4) rodar o comando:
                    php bin/console server:run`Seja Feliz
                    
*!!! Seja Feliz !!!*          