CREATE TABLE `erp_fluxocaixa` (
  `id` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `valor` varchar(55) NOT NULL,
  `data` date NOT NULL,
  `tipo` varchar(55) NOT NULL,
  `SKU` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;