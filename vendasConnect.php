<?php
date_default_timezone_set('America/Sao_Paulo');
@$MySQLiVendas = mysqli_connect('localhost', 'lojadeaplicativo_re9vendas', 'lojadeaplicativo_re9vendas', 'lojadeaplicativo_re9vendas') or die (mysqli_connect_error());
mysqli_set_charset($MySQLiVendas, 'utf8') or die (mysqli_error($MySQLiVendas));


