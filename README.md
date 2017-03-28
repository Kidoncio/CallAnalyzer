# CallAnalyzer

O CallAnalyzer foi criado para solucionar uma dificuldade que estava ocorrendo em uma pequena empresa onde havia a necessidade de se controlar e criar um histórico das ligações recebidas pelos clientes dessa empresa. Como essa empresa recebia muitas ligações, e muitas delas não eram atendidas devido a alta demanda, com o sistema conseguiu-se ganhar um aumento de 20% nas vendas devido ao retorno dado aos clientes após eles ligarem e não serem atendidos.

O CallAnalyzer utiliza o [Gentellela Admin](https://github.com/puikinsh/gentelella) para a sua interface gráfica, e utiliza o banco de dados do [Asterisk](https://wiki.asterisk.org/wiki/display/AST/Queue+Logs) para efetuar as pesquisas e as requisições em tempo real.

O Sistema ainda não está completo. A ideia inicial é poder transformar esse software básico de controle e pesquisa de informações em um verdadeiro sistema de controle de Call Center.

## Partes a serem ajustadas:
  - Criar a seção de administração de usuários, além de suas permissões de visualização.
  - Criar um pop-up para que assim que houver uma ligação, um agent seja designado para atender a determinada ligação.

## Instalação
Caso você vá instalar esse sistema, basta ter a devida comunicação com o banco de dados do Asterisk.
Feito isto, deve-se alterar as informações no arquivo `conecta.php`. Normalmente o Asterisk utiliza como base o banco `queue_log`, se você verificar e confirmar que o banco instalado é o mesmo, isso NÃO deve ser alterado.

## Sobre a Licença
O CallAnalyzer é licenciado sob o MIT License (MIT). Que basicamente signifcia que você pode usar, copiar, modificar, publicar, distribuir, sublicenciar e até mesmo vender as cópias do Software. Mas você sempre deverá informar que o [Lucas Nascimento](https://github.com/kidoncio) é o autor original dessa base de Software.

Projeto desenvolvido e mantido por [Lucas Nascimento](https://github.com/kidoncio "Lucas Nascimento - Kidoncio").
