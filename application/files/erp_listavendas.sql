CREATE TABLE `erp_listavendas` (
  `id` int(11) NOT NULL,
  `produto` varchar(255) NOT NULL,
  `quantidade` varchar(255) NOT NULL,
  `preco` varchar(255) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `chave` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;