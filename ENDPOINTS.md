### Criar Solicitação

**Method:** POST

**URL:** {{url}}/solicitation/

**Request Example:**

{
    "produtos": [
        1
    ],
    "locacao": {
          "codigo_imovel": "#ABC1234",
          "aluguel": "5000",
          "condominio": "3500",
          "iptu": "100.50",
          "tipo_imovel": "RESIDENCIAL",
          "endereco": {
            "cep": "20751380",
            "logradouro": "Rua Xisto Baía",
            "bairro": "Piedade",
            "cidade": "Rio de Janeiro",
            "uf": "RJ",
            "numero": "30",
            "complemento": "apt 300"
          }
    },
    "pretendente": {
        "tipo_pretendente": "FIADOR",
        "residir": true,
        "nome": "João {{random_nome}}",
        "cpf": "{{random_cpf}}",
          "renda": {
              "principal": {
                  "origem": 3,
                  "valor": "{{random_money}}"
              },
              "outra": {
                  "origem": 5,
                  "valor": "{{random_money}}"
              }
          }
    }
}

**Response (OK - 200):**

{
    "id": 219,
    "message": "Solicitação cadastrada"
}

**Response (Unprocessable Entity (WebDAV) (RFC 4918) - 422):**

{
    "message": {
        "pretendente.tipo_pretendente": [
            "O campo pretendente.tipo_pretendente é obrigatório."
        ]
    }
}

// ou

{
    "message": {
        "locacao.tipo_imovel": [
            "locacao.tipo imovel é inválido."
        ]
    }
}

**Response (Unprocessable Entity - 422):**

// retornos possíveis por conta da origem de renda e valor

{
    "message": "Para Valor de Renda R$0,00, selecione a opção: Origem de Renda - “Renda Não Informada”"
}

{
    "message": "Para informar um Valor de Renda, selecione alguma “Origem de Renda” diferente de “Renda Não Informada” ou digite o valor R$0,00 para prosseguir"
}

{
    "message": "Para Valor de Renda R$0,00, selecione na Origem de Renda - “Renda Não Informada” ou informe o valor para prosseguir"
}

**Response (Unprocessable Entity (WebDAV) (RFC 4918) - 422):**

{
    "message": "Para pretendente do tipo FIADOR DE ESTUDANTE informe o tipo de imóvel RESIDENCIAL"
}

// ou

{
    "message": "Não se pode ter um pretendente do tipo FIADOR DE ESTUDANTE em uma locação do tipo NÃO RESIDENCIAL"
}

// ou

{
    "message": "O campo pretendente.participante é obrigatório quando pretendente.tipo_pretendente é INQUILINO e locacao.tipo_imovel é NAO_RESIDENCIAL"
}

**Response (Unprocessable Entity (WebDAV) (RFC 4918) - 422):**

{
    "message": "Este cliente não possui o produto $tituloProduto disponível para solicitação"
}

**Response (Unprocessable Entity (WebDAV) (RFC 4918) - 422):**

{
    "message": "Não se pode usar um CPF para o produto fc empresa. Utilize um CNPJ"
}

// ou

{
    "message": "Não se pode usar um CNPJ para o produto fc essencial ou fc report. Utilize um CPF"
}

**Response (Unprocessable Entity (WebDAV) (RFC 4918) - 422):**

{
    "message": "Não se pode usar um CPF para o produto fc empresa. Utilize um CNPJ"
}

// ou

{
    "message": "Não se pode usar um CNPJ para o produto fc essencial ou fc report. Utilize um CPF"
}

**Response (Unprocessable Entity (WebDAV) (RFC 4918) - 422):**

{
    "message": "O documento escolhido já está atrelado a outra solicitação/pretendente"
}

**Response (None - None):**



### Lista de Solicitação

**Method:** GET

**URL:** {{url}}/solicitation/?perPage=&page=&sort&start_date=&end_date=&filter=

**Response (OK - 200):**

{
    "pagination": {
        "per_page": 25,
        "current_page": 1,
        "last_page": 1,
        "from": 1,
        "to": 2,
        "itens_page": 2,
        "total": 2
    },
    "data": [
        {
            "id": 126,
            "status": "FINALIZADO",
            "data_criacao": "2019-03-20 16:10:02",
            "cliente_id": 142,
            "cliente_nome": "CLIENTE JOÃO LTDA.",
            "pretendentes": [
                {
                    "id": 259,
                    "tipo_pretendente": "INQUILINO",
                    "nome": "HOMERO DE ARAUJO SILVA",
                    "cpf": "73411246600",
                    "data_nascimento": "1980-02-20",
                    "nome_mae": "MARIA SILVA",
                    "residir": false,
                    "participante": true,
                    "produtos": [
                        {
                            "id": 1,
                            "nome": "FC ANALISE",
                            "status": "CONCLUIDO",
                            "data": "2019-03-20 16:10:02",
                            "data_atualizacao": "2019-03-20 16:10:02"
                        }
                    ],
                    "renda": {
                        "principal": {
                            "origem": 3,
                            "titulo": "Funcionário Público (CLT)",
                            "valor": "5034.31",
                            "documentos": []
                        },
                        "outra": {
                            "origem": 4,
                            "titulo": "Empresário",
                            "valor": "5034.31",
                            "documentos": []
                        },
                        "confirmada": [],
                        "analises": []
                    }
                },
                {
                    "id": 260,
                    "tipo_pretendente": "INQUILINO",
                    "nome": "VALDIR JOSE DA COSTA",
                    "cpf": "13421964572",
                    "data_nascimento": "1967-07-30",
                    "nome_mae": "ELZA SILVA",
                    "residir": false,
                    "participante": true,
                    "produtos": [
                        {
                            "id": 1,
                            "nome": "FC ANALISE",
                            "status": "CONCLUIDO",
                            "data": "2019-03-20 16:10:30",
                            "data_atualizacao": "2019-03-20 16:10:30"
                        }
                    ],
                    "renda": {
                        "principal": {
                            "origem": 3,
                            "titulo": "Funcionário Público (CLT)",
                            "valor": "5034.31",
                            "documentos": []
                        },
                        "outra": {
                            "origem": 4,
                            "titulo": "Empresário",
                            "valor": "5034.31",
                            "documentos": []
                        },
                        "confirmada": [],
                        "analises": []
                    }
                }
            ],
            "locacao": {
                "codigo_imovel": "I-1234",
                "aluguel": "2300.00",
                "condominio": "400.00",
                "iptu": "90.00",
                "tipo_imovel": "RESIDENCIAL",
                "endereco": [
                    {
                        "logradouro": "Rua Marques de Sao Vicente",
                        "numero": "512",
                        "complemento": null,
                        "bairro": "Gávea",
                        "cidade": "Rio de Janeiro",
                        "uf": "RJ",
                        "cep": "22451040"
                    }
                ]
            }
        },
        {
            "id": 121,
            "status": "FINALIZADO",
            "data_criacao": "2019-03-19 17:26:33",
            "cliente_id": 142,
            "cliente_nome": "CLIENTE JOÃO LTDA.",
            "pretendentes": [
                {
                    "id": 236,
                    "tipo_pretendente": "INQUILINO",
                    "nome": "FABIO MACHADO",
                    "cpf": "39283375483",
                    "data_nascimento": "1976-09-12",
                    "nome_mae": null,
                    "residir": true,
                    "participante": true,
                    "produtos": [
                        {
                            "id": 1,
                            "nome": "FC ANALISE",
                            "status": "CONCLUIDO",
                            "data": "2019-03-19 17:26:33",
                            "data_atualizacao": "2019-03-19 17:26:33"
                        }
                    ],
                    "renda": {
                        "principal": {
                            "origem": 3,
                            "titulo": "Funcionário Público (CLT)",
                            "valor": "5034.31",
                            "documentos": []
                        },
                        "outra": {
                            "origem": 4,
                            "titulo": "Empresário",
                            "valor": "5034.31",
                            "documentos": []
                        },
                        "confirmada": [],
                        "analises": []
                    }
                },
                {
                    "id": 237,
                    "tipo_pretendente": "FIADOR",
                    "nome": "SUSAN OLIVEIRA",
                    "cpf": "87828884265",
                    "data_nascimento": "1970-04-16",
                    "nome_mae": "JUDITH DA COSTA",
                    "residir": false,
                    "participante": false,
                    "produtos": [
                        {
                            "id": 1,
                            "nome": "FC ANALISE",
                            "status": "CONCLUIDO",
                            "data": "2019-03-19 17:33:37",
                            "data_atualizacao": "2019-03-19 17:33:37"
                        }
                    ],
                    "renda": {
                        "principal": {
                            "origem": 3,
                            "titulo": "Funcionário Público (CLT)",
                            "valor": "5034.31",
                            "documentos": []
                        },
                        "outra": {
                            "origem": 4,
                            "titulo": "Empresário",
                            "valor": "5034.31",
                            "documentos": []
                        },
                        "confirmada": [],
                        "analises": []
                    }
                }
            ],
            "locacao": {
                "codigo_imovel": "c-5555",
                "aluguel": "2000.00",
                "condominio": "660.11",
                "iptu": "300.00",
                "tipo_imovel": "RESIDENCIAL",
                "endereco": [
                    {
                        "logradouro": "Rua Senador Muniz Freire",
                        "numero": "1710",
                        "complemento": "5001",
                        "bairro": "Vila Isabel",
                        "cidade": "Rio de Janeiro",
                        "uf": "RJ",
                        "cep": "20541040"
                    }
                ]
            }
        }
    ]
}

**Response (Unprocessable Entity (WebDAV) (RFC 4918) - 422):**

{
    "message": "status é inválido."
}

**Response (Unprocessable Entity (WebDAV) (RFC 4918) - 422):**

{
    "message": "formato inválido para start_date."
}

// ou

{
    "message": "formato inválido para end_date."
}

// ou

{
    "message": "A data final precisa ser igual ou depois da data inicial"
}
// ou

{
    "message": "produto é inválido"
}



### Detalhe da Solicitação

**Method:** GET

**URL:** {{url}}/solicitation/:solicitation

**Response (OK - 200):**

{
    "data": {
        "id": 121,
        "status": "FINALIZADO",
        "data_criacao": "2019-03-19 17:26:33",
        "cliente_id": 142,
        "cliente_nome": "CLIENTE JOÃO LTDA.",
        "locacao": {
            "codigo_imovel": "C-5555",
            "aluguel": "2000.00",
            "condominio": "660.11",
            "iptu": "300.00",
            "tipo_imovel": "RESIDENCIAL",
            "endereco": [
                {
                    "logradouro": "Rua Senador Muniz Freire",
                    "numero": "1700",
                    "complemento": "7001",
                    "bairro": "Vila Isabel",
                    "cidade": "Rio de Janeiro",
                    "uf": "RJ",
                    "cep": "20541040"
                }
            ]
        },
        "pretendentes": [
            {
                "id": 236,
                "tipo_pretendente": "INQUILINO",
                "nome": "FABIO MACHADO SILVA",
                "cpf": "89636988900",
                "data_nascimento": "1987-06-04",
                "nome_mae": "MARIA DA SILVA",
                "residir": true,
                "participante": true,
                "produtos": [
                    {
                        "id": 1,
                        "nome": "FC ANALISE",
                        "status": "CONCLUIDO",
                        "data": "2019-03-19 17:26:33",
                        "data_atualizacao": "2019-03-19 17:26:33"
                    }
                ],
                "renda": {
                    "principal": {
                        "origem": 5,
                        "titulo": "Profissional Liberal ou Autônomo",
                        "valor": "11000.00"
                    },
                    "outra": {
                        "origem": 8,
                        "titulo": "Pensão Alimentícia ou Judicial",
                        "valor": "2000.00"
                    }
                }
            },
            {
                "id": 237,
                "tipo_pretendente": "FIADOR",
                "nome": "SUSAN MOREIRA",
                "cpf": "83686171384",
                "data_nascimento": "1989-10-20",
                "nome_mae": "JUDITH COSTA",
                "residir": false,
                "participante": false,
                "produtos": [
                    {
                        "id": 1,
                        "nome": "FC ANALISE",
                        "status": "CONCLUIDO",
                        "data": "2019-03-19 17:33:37",
                        "data_atualizacao": "2019-03-19 17:33:37"
                    }
                ],
                "renda": {
                    "principal": {
                        "origem": 4,
                        "titulo": "Empresário",
                        "valor": "5100.00"
                    },
                    "outra": {
                        "origem": 1,
                        "titulo": "Outros / Não informado",
                        "valor": "1000.00"
                    }
                }
            }
        ]
    }
}

**Response (Not Found - 404):**

{
    "message": "Solicitacao não encontrado."
}



### Visualizar Crédito Disponível

**Method:** GET

**URL:** {{url}}/solicitation/credits

**Response (OK - 200):**

{
    "data": {
        "id": 121,
        "status": "FINALIZADO",
        "data_criacao": "2019-03-19 17:26:33",
        "cliente_id": 142,
        "cliente_nome": "CLIENTE JOÃO LTDA.",
        "locacao": {
            "codigo_imovel": "C-5555",
            "aluguel": "2000.00",
            "condominio": "660.11",
            "iptu": "300.00",
            "tipo_imovel": "RESIDENCIAL",
            "endereco": [
                {
                    "logradouro": "Rua Senador Muniz Freire",
                    "numero": "1700",
                    "complemento": "7001",
                    "bairro": "Vila Isabel",
                    "cidade": "Rio de Janeiro",
                    "uf": "RJ",
                    "cep": "20541040"
                }
            ]
        },
        "pretendentes": [
            {
                "id": 236,
                "tipo_pretendente": "INQUILINO",
                "nome": "FABIO MACHADO SILVA",
                "cpf": "89636988900",
                "data_nascimento": "1987-06-04",
                "nome_mae": "MARIA DA SILVA",
                "residir": true,
                "participante": true,
                "produtos": [
                    {
                        "id": 1,
                        "nome": "FC ANALISE",
                        "status": "CONCLUIDO",
                        "data": "2019-03-19 17:26:33",
                        "data_atualizacao": "2019-03-19 17:26:33"
                    }
                ],
                "renda": {
                    "principal": {
                        "origem": 5,
                        "titulo": "Profissional Liberal ou Autônomo",
                        "valor": "11000.00"
                    },
                    "outra": {
                        "origem": 8,
                        "titulo": "Pensão Alimentícia ou Judicial",
                        "valor": "2000.00"
                    }
                }
            },
            {
                "id": 237,
                "tipo_pretendente": "FIADOR",
                "nome": "SUSAN MOREIRA",
                "cpf": "83686171384",
                "data_nascimento": "1989-10-20",
                "nome_mae": "JUDITH COSTA",
                "residir": false,
                "participante": false,
                "produtos": [
                    {
                        "id": 1,
                        "nome": "FC ANALISE",
                        "status": "CONCLUIDO",
                        "data": "2019-03-19 17:33:37",
                        "data_atualizacao": "2019-03-19 17:33:37"
                    }
                ],
                "renda": {
                    "principal": {
                        "origem": 4,
                        "titulo": "Empresário",
                        "valor": "5100.00"
                    },
                    "outra": {
                        "origem": 1,
                        "titulo": "Outros / Não informado",
                        "valor": "1000.00"
                    }
                }
            }
        ]
    }
}

**Response (Not Found - 404):**

{
    "message": "Solicitacao não encontrado."
}



### Editar Solicitação

**Method:** PUT

**URL:** {{url}}/solicitation/:solicitation

**Request Example:**

{
	"codigo_imovel": "C-1234",
  	"aluguel": "5000",
	"condominio": "3500",
	"iptu": "100.50",
	"tipo_imovel": "RESIDENCIAL",
	"endereco": {
		"cep": "20751380",
		"logradouro": "Rua Xisto Baía",
		"bairro": "Piedade",
		"cidade": "Rio de Janeiro",
		"uf": "RJ",
		"numero": "30",
		"complemento": "apt 300"
  	}
}

**Response (Unprocessable Entity - 422):**

{
    "message": "Não é possível atualizar uma locação para tipo de imóvel NÃO RESIDENCIAL quando na mesma existe pretendente do tipo FIADOR DE ESTUDANTE"
}

**Response (OK - 200):**

{
    "message": "Locação Atualizada"
}



### Remover Solicitação

**Method:** DELETE

**URL:** {{url}}/solicitation/:solicitation

**Response (Unprocessable Entity - 422):**

{
    "message": "Uma solicitação somente pode ser removida, quando ainda não solicitada a geração do laudo para nenhum de seus pretendentes"
}

**Response (OK - 200):**

{
    "message": "Solicitação, pretendentes e dados relacionados, removidos"
}

**Response (Not Found - 404):**

{
    "message": "Solicitacao não encontrado."
}



### Adicionar Arquivo (Anexo)

**Method:** POST

**URL:** {{url}}/solicitation/:solicitation/applicant/:applicant/product/:product/file



### Remover Arquivo (Anexo)

**Method:** DELETE

**URL:** {{url}}/solicitation/:solicitation/applicant/:applicant/product/:product/file/:file



### Adicionar Produto

**Method:** POST

**URL:** {{url}}/solicitation/:solicitation/applicant/:applicant/product/:product

**Response (OK - 200):**

{
    "message": "Produto vinculado ao pretendente"
}

**Response (Not Found - 404):**

{
    "message": "Solicitacao não encontrado."
}

// ou

{
    "message": "Pretendente não encontrado."
}

// ou

{
    "message": "Produto não encontrado."
}

**Response (Unprocessable Entity (WebDAV) (RFC 4918) - 422):**

{
    "message": "Este pretendente não pertence a esta solicitação"
}

// ou

{
    "message": "Este pretendente já possui este produto"
}

// ou

{
    "message": "Já existe um fc básico incluído a este pretendente. Finalize-o para incluir o fc essencial."
}

// ou

{
    "message": "Já existe um fc essencial incluído a este pretendente. Finalize-o para incluir o fc report."
}

// ou

{
    "message": "Já existe um fc básico incluído a este pretendente. Finalize-o para incluir o fc report."
}

// ou

{
    "message": "Já existe um fc básico incluído a este pretendente. Finalize-o para incluir o fc report."
}



### Reinclusão de produto

**Method:** POST

**URL:** {{url}}/solicitation/:solicitation/applicant/:applicant/product/:product/reinclusion

**Response (OK - 200):**

{
    "message": "Produto atualizado com status de Reinclusão"
}



### Remover Reinclusão de produto

**Method:** DELETE

**URL:** {{url}}/solicitation/:solicitation/applicant/:applicant/product/:product/reinclusion

**Response (OK - 200):**

{
    "message": "Reinclusão do produto removida"
}



### Criar Novo Pretendente

**Method:** POST

**URL:** {{url}}/solicitation/:solicitation/applicant/

**Request Example:**

{
	"produtos": [
		1
	],
	"pretendente": {
		"tipo_pretendente": "INQUILINO",
	  	"residir": true,
		"nome": "Nome do Pretendente",
		"cpf": "64619844705",
		"data_nascimento": "1988-12-15",
		"nome_mae": "Maria Mãe do Pretendente",
		"endereco": {
			"cep": "68900971",
			"logradouro": "Avenida Diógenes Silva 1894",
			"bairro": "Buritizal",
			"cidade": "Macapao",
			"uf": "AP",
			"numero": "30000",
			"complemento": "fundos"
  		},
  		"renda": {
  			"principal": {
  				"origem": 2,
  				"valor": "5000"
  			},
  			"outra": {
  				"origem": 3,
  				"valor": "7500"
  			}
  		}
	}
}

**Response (OK - 200):**

{
    "id": 571,
    "message": "Pretendente cadastrado"
}

**Response (Unprocessable Entity - 422):**

// retornos possíveis por conta da origem de renda e valor

{
    "message": "Para Valor de Renda R$0,00, selecione a opção: Origem de Renda - “Renda Não Informada”"
}

{
    "message": "Para informar um Valor de Renda, selecione alguma “Origem de Renda” diferente de “Renda Não Informada” ou digite o valor R$0,00 para prosseguir"
}

{
    "message": "Para Valor de Renda R$0,00, selecione na Origem de Renda - “Renda Não Informada” ou informe o valor para prosseguir"
}

**Response (Unprocessable Entity (WebDAV) (RFC 4918) - 422):**

{
    "message": "Não é possível cadastrar um pretendente do tipo FIADOR DE ESTUDANTE em uma solicitação do tipo NÃO RESIDENCIAL"
}

**Response (Unprocessable Entity (WebDAV) (RFC 4918) - 422):**

{
    "message": "Você não pode executar esta operação pois a administradora está com o status de $status"
}

**Response (Unprocessable Entity (WebDAV) (RFC 4918) - 422):**

{
    "message": "Você não pode executar esta operação pois sua conta está suspensa"
}

**Response (Not Found - 404):**

{
    "message": "Solicitacao não encontrado."
}

**Response (Not Found - 404):**

{
    "message": "Não se pode usar um CPF para o produto fc empresa. Utilize um CNPJ"
}

// ou

{
    "message": "Não se pode usar um CNPJ para o produto fc essencial ou fc report. Utilize um CPF"
}

**Response (Not Found - 404):**

{
    "message": "Já existe um pretendente com este CPF nesta solicitação. Tente outro."
}

// ou

{
    "message": "Já existe um pretendente com este CNPJ nesta solicitação. Tente outro."
}



### Detalhe do Pretendente

**Method:** GET

**URL:** {{url}}/solicitation/:solicitation/applicant/:applicant

**Response (OK - 200):**

{
    "data": {
        "id": 219,
        "status": "PENDENTE",
        "data_criacao": "2019-07-15 13:45:02",
        "cliente_id": 142,
        "cliente_nome": "CLIENTE JOÃO LTDA.",
        "locacao": {
            "codigo_imovel": "C-1234",
            "aluguel": "5000.00",
            "condominio": "3500.00",
            "iptu": "100.50",
            "tipo_imovel": "RESIDENCIAL",
            "endereco": [
                {
                    "logradouro": "Rua Xisto Baía",
                    "numero": "30",
                    "complemento": "apt 300",
                    "bairro": "Piedade",
                    "cidade": "Rio de Janeiro",
                    "uf": "RJ",
                    "cep": "20751380"
                }
            ]
        },
        "pretendente": [
            {
                "id": 571,
                "tipo_pretendente": "INQUILINO",
                "nome": "NOME DO PRETENDENTE",
                "cpf": "64619844705",
                "data_nascimento": "1988-12-15",
                "nome_mae": "Maria Mãe do Pretendente",
                "residir": true,
                "participante": true,
                "produtos": [
                    {
                        "id": 1,
                        "nome": "FC ANALISE",
                        "status": "INCLUIDO",
                        "data": "2019-07-15 14:23:18",
                        "data_atualizacao": "2019-07-15 14:23:18"
                    }
                ],
                "renda": {
                    "principal": {
                        "origem": 2,
                        "titulo": "Funcionário Público (Estatutário)",
                        "valor": "5000.00"
                    },
                    "outra": {
                        "origem": 3,
                        "titulo": "Funcionário Público (CLT)",
                        "valor": "7500.00"
                    }
                }
            }
        ]
    }
}

**Response (Not Found - 404):**

{
    "message": "Solicitacao não encontrado."
}

**Response (Not Found - 404):**

{
    "message": "Pretendente não encontrado."
}

**Response (Unprocessable Entity (WebDAV) (RFC 4918) - 422):**

{
    "message": "Este pretendente não pertence a esta solicitação"
}



### Editar Pretendente

**Method:** PUT

**URL:** {{url}}/solicitation/:solicitation/applicant/:applicant

**Request Example:**

{
	"pretendente": {
		"tipo_pretendente": "INQUILINO",
		"nome": "Nome do Pretendente",
		"cpf": "76827821536",
        "cpf_pendente": false,
        "renda": {
            "principal": {
                "origem": 2,
                "valor": "6000"
            },
            "outra": {
                "origem": 7,
                "valor": "2500.50"
            }
        }

	}
}

**Response (Unprocessable Entity (WebDAV) (RFC 4918) - 422):**

{
    "message": "Não é possível atualizar um pretendente para o tipo FIADOR DE ESTUDANTE em uma solicitação do tipo NÃO RESIDENCIAL"
}

// ou

{
    "message": "O campo pretendente.participante é obrigatório quando pretendente.tipo_pretendente é INQUILINO e locacao.tipo_imovel é NAO_RESIDENCIAL."
}

// ou

{
    "message": "O status atual deste produto ($status) não permite uma Reinclusão"
}

**Response (Unprocessable Entity (WebDAV) (RFC 4918) - 422):**

{
    "message": "Este pretendente não pertence a esta solicitação"
}

**Response (Unprocessable Entity (WebDAV) (RFC 4918) - 422):**

{
    "message": "Já existe um pretendente com este CPF nesta solicitação. Tente outro."
}

// ou

{
    "message": "Já existe um pretendente com este CNPJ nesta solicitação. Tente outro."
}

**Response (OK - 200):**

{
    "message": "Pretendente Atualizado"
}

**Response (Unprocessable Entity - 422):**

// retornos possíveis por conta da origem de renda e valor

{
    "message": "Para Valor de Renda R$0,00, selecione a opção: Origem de Renda - “Renda Não Informada”"
}

{
    "message": "Para informar um Valor de Renda, selecione alguma “Origem de Renda” diferente de “Renda Não Informada” ou digite o valor R$0,00 para prosseguir"
}

{
    "message": "Para Valor de Renda R$0,00, selecione na Origem de Renda - “Renda Não Informada” ou informe o valor para prosseguir"
}

**Response (Not Found - 404):**

{
    "message": "Solicitacao não encontrado."
}

**Response (Not Found - 404):**

{
    "message": "Pretendente não encontrado."
}



### Remover Pretendente

**Method:** DELETE

**URL:** {{url}}/solicitation/:solicitation/applicant/:applicant

**Response (Unprocessable Entity - 422):**

{
    "message": "Um Pretendente somente pode ser removido, quando ainda não foi solicitada a geração do laudo para nenhum de seus produtos"
}

// ou

{
    "message": "A operação não pode ser executada pois existem laudos para os pretendentes desta solicitação"
}

// ou

{
    "message": "Este pretendente não pertence a esta solicitação"
}

**Response (OK - 200):**

{
    "message": "Pretendente removido da solicitação"
}

**Response (Not Found - 404):**

{
    "message": "Solicitacao não encontrado."
}

// ou

{
    "message": "Pretendente não encontrado."
}



### Cadastrar um webhook

**Method:** POST

**URL:** {{url}}/solicitation/report/webhook

**Request Example:**

{
    "endpoint": "https://endpoint-do-webhook.com",
    "token_url": "https://url/definido-pelo-cliente/gerar-token",
    "token_user": "client/usuario",
    "token_password": "secret/senha"
}



### Lista de Webhook

**Method:** GET

**URL:** {{url}}/solicitation/report/webhook



### Remover Webhook

**Method:** DELETE

**URL:** {{url}}/solicitation/report/webhook/:webhook



### Visualizar Laudo

**Method:** GET

**URL:** {{url}}/solicitation/:solicitation/report

**Response (OK - 200):**

{
    "solicitacao": {
        "id": 220,
        "solicitante": "JOHN DOE",
        "cliente_id": 142,
        "cliente_nome": "CLIENTE JOÃO LTDA.",
        "status": "CONCLUIDA",
        "data_criacao": "2019-07-15 17:03:41",
        "data_conclusao": "2019-07-17 19:17:33"
    },
    "locacao": {
        "endereco": [
            {
                "uf": "RJ",
                "cidade": "Rio de Janeiro",
                "complemento": "apt 300",
                "numero": "350",
                "logradouro": "Rua Xisto Baía",
                "bairro": "Piedade",
                "cep": "20751380"
            }
        ],
        "codigo_imovel": "#C-1234",
        "condominio": "3500.00",
        "aluguel": "5000.00",
        "proprietario": "Nome do Proprietário",
        "cpf_cnpj_proprietario": null,
        "iptu": "100.50",
        "tipo_imovel": "RESIDENCIAL"
    },
    "pretendentes": [
        {
            "pessoa": {
                "id": 572,
                "residir": true,
                "participante": true,
                "data_nascimento": "1980-02-14",
                "nome": "ANTONIO NUNES",
                "tipo_pretendente": "INQUILINO",
                "cpf": "61223744310",
                "nome_mae": "PAULA DA SILVA",
                "renda": {
                    "principal": {
                        "origem": 2,
                        "valor": "6000.00",
                        "titulo": "Funcionário Público (Estatutário)"
                    },
                    "outra": {
                        "origem": 7,
                        "valor": "2500.50",
                        "titulo": "Renda de Aluguel"
                    }
                },
                "produtos": [
                    {
                        "id": 1,
                        "nome": "FC ANALISE",
                        "status": "CONCLUIDO",
                        "data_atualizacao": "2019-07-15 17:03:41",
                        "data": "2019-07-15 17:03:41"
                    }
                ]
            },
            "laudo": {
                "data_conclusao": "2019-03-20 17:00:36",
                "restricoes_financeiras": {
                    "result": {
                        "protestos": {
                            "resumo": {},
                            "detalhes": [],
                            "info": "NADA CONSTA"
                        },
                        "pendencias": {
                            "resumo": {},
                            "detalhes": [],
                            "info": "NADA CONSTA"
                        },
                        "acoes": {
                            "resumo": {},
                            "detalhes": [],
                            "info": "NADA CONSTA"
                        },
                        "cheques": {
                            "resumo": {},
                            "detalhes": [],
                            "info": "NADA CONSTA"
                        }
                    },
                    "icon": "positivo",
                    "recommendation": [],
                    "caution": []
                },
                "veracidade_celular": {
                    "result": [
                        {
                            "phone": "48123456789"
                        },
                        {
                            "phone": "48234567890"
                        },
                        {
                            "phone": "48345678901"
                        },
                        {
                            "phone": "48456789012"
                        }
                    ],
                    "icon": "neutro",
                    "recommendation": [],
                    "caution": []
                },
                "veracidade_email": {
                    "result": [
                        {
                            "email": "EMAIL@YAHOO.COM.BR"
                        }
                    ],
                    "icon": "neutro",
                    "recommendation": [],
                    "caution": []
                },
                "parecer_sistemico": [
                    {
                        "parecer": "RENDA INCOMPATÍVEL",
                        "score_fc": 228,
                        "recomendacao": [
                            "RECOMENDA-SE A COMPLEMENTAÇÃO OU A COMPOSIÇÃO DE RENDA COM OUTRO(S) PRETENDENTE(S)."
                        ],
                        "risco": null
                    }
                ],
                "rede_ficha": {
                    "result": {
                        "result": "Consta",
                        "icon": "neutro",
                        "recommendation": [],
                        "caution": []
                    },
                    "pesquisas_anteriores_api": {
                        "result": {
                            "total": 1,
                            "passages": [
                                {
                                    "data_consulta": "2019-03-17",
                                    "nome_empresa": "SERVICOS DE TELECOM",
                                    "modalidade_consulta": null,
                                    "valor_consulta": null
                                }
                            ]
                        },
                        "icon": "neutro",
                        "recommendation": [],
                        "caution": []
                    }
                },
                "compatibilidade_renda": {
                    "result": {
                        "valor_locacao": 8600,
                        "renda": 8500,
                        "vezes": 0.9883720930232558
                    },
                    "recommendation": {
                        "titulo": "Considerando uma locação de imóvel residencial para uso próprio",
                        "observacoes": [
                            "A RENDA PESSOAL declarada (1 vezes o valor da locação) é incompatível ‌com esta locação.",
                            "Verificar a possibilidade de composição de renda com outra(s) pessoa(s).",
                            "É recomendável solicitar comprovação da renda declarada."
                        ]
                    },
                    "icon": "negativo",
                    "caution": []
                },
                "veracidade_telefone": {
                    "result": [
                        {
                            "phone": "4812345678"
                        },
                        {
                            "phone": "4823456789"
                        }
                    ],
                    "icon": "neutro",
                    "recommendation": [],
                    "caution": []
                },
                "veracidade_data_nascimento": {
                    "result": {
                        "data_nascimento": "1980-10-14",
                        "idade": 38
                    },
                    "icon": "neutro",
                    "recommendation": [],
                    "caution": []
                },
                "participacao_empresarial": {
                    "result": "Não apurado",
                    "icon": "nulo",
                    "recommendation": [],
                    "caution": []
                },
                "situacao_cpf": {
                    "result": "Ativo",
                    "icon": "positivo",
                    "recommendation": [],
                    "caution": []
                },
                "principal_origem_renda": {
                    "result": {
                        "origem": "Funcionário Público (Estatutário)",
                        "documentacao": [
                            "FUNCIONÁRIO PÚBLICO (Com estabilidade): Contracheque atual ou publicação no diário oficial.",
                            "Sugestão Alternativa: Extratos bancários dos últimos 3 meses completos ou último Extrato/Fatura do Cartão de Crédito com limite superior a 4 vezes o valor da locação."
                        ]
                    },
                    "icon": "neutro",
                    "recommendation": [],
                    "caution": []
                },
                "outra_origem_renda": {
                    "result": {
                        "origem": "Renda de Aluguel",
                        "documentacao": [
                            "RENDA DE ALUGUEL: Declaração do I.R. na íntegra com Recibo de Entrega e/ou Extratos Bancários completos dos últimos 3 meses.",
                            "Sugestão Alternativa: último Extrato/Fatura do Cartão de Crédito."
                        ]
                    },
                    "icon": "neutro",
                    "recommendation": [],
                    "caution": []
                },
                "veracidade_endereco": {
                    "result": [
                        {
                            "address": {
                                "uf": "RS",
                                "cidade": "PELOTAS",
                                "complemento": null,
                                "numero": "617",
                                "bairro": "LARANJAL",
                                "logradouro": "R VILA DE MAIA 617 - LARANJAL - PELOTAS - RS - 96083000",
                                "cep": "96083000"
                            }
                        },
                        {
                            "address": {
                                "logradouro": "R CRISTOVAO RIBEIRO FILHO 25 FUNDOS - AREIAS - SAO JOSE - SC - 88113814",
                                "uf": "SC",
                                "cidade": "SAO JOSE",
                                "complemento": "FUNDOS",
                                "numero": "2500",
                                "bairro": "AREIAS",
                                "cep": "88113814"
                            }
                        },
                        {
                            "address": {
                                "logradouro": "R AUGUSTO JORGE BRUGGEMANN 181 AP 202 - AREIAS - SAO JOSE - SC - 88113823",
                                "uf": "SC",
                                "cidade": "SAO JOSE",
                                "complemento": "AP 202",
                                "numero": "1810",
                                "bairro": "AREIAS",
                                "cep": "88113823"
                            }
                        }
                    ],
                    "icon": "neutro",
                    "recommendation": [],
                    "caution": []
                },
                "veracidade_nome": {
                    "result": "ANTONIO NUNES",
                    "icon": "neutro",
                    "recommendation": [],
                    "caution": []
                },
                "suspeita_obito": {
                    "result": false,
                    "icon": "positivo",
                    "recommendation": [],
                    "caution": []
                },
                "perfil_socioeconomico": {
                    "result": {
                        "estado_civil": null,
                        "valor_locacao": 8600.5,
                        "escolaridade": "ENSINO SUPERIOR",
                        "ocupacao": "ANALISTA DE NEGÓCIOS",
                        "renda": 4079,
                        "vezes": 0.4742747514679379
                    },
                    "icon": "neutro",
                    "recommendation": {
                        "titulo": "Considerando uma locação de imóvel residencial para uso próprio",
                        "observacoes": [
                            "O comprometimento de 0,5 vezes o valor da locação da RENDA PRESUMIDA sistêmica não é compatível com esta locação.",
                            "A renda presumida é apenas uma informação sistêmica baseada em dados estatísticos e de mercado."
                        ]
                    },
                    "caution": []
                },
                "veracidade_nome_mae": {
                    "result": "PAULA DA SILVA",
                    "icon": "neutro",
                    "recommendation": [],
                    "caution": []
                }
            }
        },
        {
            "pessoa": {
                "id": 573,
                "residir": true,
                "participante": true,
                "nome": "JULIA DA SILVA",
                "data_nascimento": "1988-12-15",
                "tipo_pretendente": "INQUILINO",
                "cpf": "52978015918",
                "nome_mae": "MARIA DA SILVA",
                "endereco": [
                    {
                        "uf": "AP",
                        "cidade": "Macapao",
                        "complemento": "fundos",
                        "numero": "30000",
                        "logradouro": "Avenida Diógenes Silva 1894",
                        "bairro": "Buritizal",
                        "cep": "68900971"
                    }
                ],
                "renda": {
                    "principal": {
                        "origem": 2,
                        "valor": "5000.00",
                        "titulo": "Funcionário Público (Estatutário)"
                    },
                    "outra": {
                        "origem": 3,
                        "valor": "7500.00",
                        "titulo": "Funcionário Público (CLT)"
                    }
                },
                "produtos": [
                    {
                        "id": 1,
                        "nome": "FC ANALISE",
                        "status": "SOLICITADO",
                        "data": "2019-07-17 14:19:20",
                        "data_atualizacao": "2019-07-17 14:19:28"
                    }
                ]
            },
            "laudo": {
                "data_conclusao": "2019-03-20 17:00:36",
                "restricoes_financeiras": {
                    "result": {
                        "protestos": {
                            "resumo": {},
                            "detalhes": [],
                            "info": "NADA CONSTA"
                        },
                        "pendencias": {
                            "resumo": {},
                            "detalhes": [],
                            "info": "NADA CONSTA"
                        },
                        "acoes": {
                            "resumo": {},
                            "detalhes": [],
                            "info": "NADA CONSTA"
                        },
                        "cheques": {
                            "resumo": {},
                            "detalhes": [],
                            "info": "NADA CONSTA"
                        }
                    },
                    "icon": "positivo",
                    "recommendation": [],
                    "caution": []
                },
                "veracidade_celular": {
                    "result": [
                        {
                            "phone": "48123456789"
                        },
                        {
                            "phone": "48234567890"
                        }
                    ],
                    "icon": "neutro",
                    "recommendation": [],
                    "caution": []
                },
                "veracidade_email": {
                    "result": [
                        {
                            "email": "EMAIL@GMAIL.COM"
                        }
                    ],
                    "icon": "neutro",
                    "recommendation": [],
                    "caution": []
                },
                "parecer_sistemico": [
                    {
                        "parecer": "RENDA INCOMPATÍVEL",
                        "score_fc": 178,
                        "recomendacao": [
                            "RECOMENDA-SE A COMPLEMENTAÇÃO OU A COMPOSIÇÃO DE RENDA COM OUTRO(S) PRETENDENTE(S)."
                        ],
                        "risco": null
                    }
                ],
                "rede_ficha": {
                    "result": {
                        "result": "Consta",
                        "icon": "neutro",
                        "recommendation": [],
                        "caution": []
                    },
                    "pesquisas_anteriores_api": {
                        "result": {
                            "total": 1,
                            "passages": [
                                {
                                    "data_consulta": "2019-03-17",
                                    "modalidade_consulta": null,
                                    "nome_empresa": "SERVICOS DE TELECOM",
                                    "valor_consulta": null
                                }
                            ]
                        },
                        "icon": "neutro",
                        "recommendation": [],
                        "caution": []
                    }
                },
                "compatibilidade_renda": {
                    "result": {
                        "valor_locacao": 8600,
                        "renda": 12500,
                        "vezes": 1.4534883720930232
                    },
                    "icon": "negativo",
                    "recommendation": {
                        "titulo": "Considerando uma locação de imóvel residencial para uso próprio",
                        "observacoes": [
                            "A RENDA PESSOAL declarada (1,5 vezes o valor da locação) é incompatível com esta locação.",
                            "Verificar a possibilidade de composição de renda com outra(s) pessoa(s).",
                            "É recomendável solicitar comprovação da renda declarada."
                        ]
                    },
                    "caution": []
                },
                "veracidade_telefone": {
                    "result": [],
                    "icon": "neutro",
                    "recommendation": [],
                    "caution": []
                },
                "veracidade_data_nascimento": {
                    "result": {
                        "data_nascimento": "1980-10-14",
                        "idade": 38
                    },
                    "icon": "neutro",
                    "recommendation": [],
                    "caution": []
                },
                "participacao_empresarial": {
                    "result": "Não apurado",
                    "icon": "nulo",
                    "recommendation": [],
                    "caution": []
                },
                "situacao_cpf": {
                    "result": "Ativo",
                    "icon": "positivo",
                    "recommendation": [],
                    "caution": []
                },
                "principal_origem_renda": {
                    "result": {
                        "origem": "Funcionário Público (Estatutário)",
                        "documentacao": [
                            "FUNCIONÁRIO PÚBLICO (Com estabilidade): Contracheque atual ou publicação no diário oficial.",
                            "Sugestão Alternativa: Extratos bancários dos últimos 3 meses completos ou último Extrato/Fatura do Cartão de Crédito com limite superior a 4 vezes o valor da locação."
                        ]
                    },
                    "icon": "neutro",
                    "recommendation": [],
                    "caution": []
                },
                "outra_origem_renda": {
                    "result": {
                        "origem": "Funcionário Público (CLT)",
                        "documentacao": [
                            "FUNCIONÁRIO PÚBLICO (Sem estabilidade): Contracheque atual ou publicação no diário oficial.",
                            "Sugestão Alternativa: Extratos bancários dos últimos 3 meses completos ou último Extrato/Fatura do Cartão de Crédito com limite superior a 4 vezes o valor da locação."
                        ]
                    },
                    "icon": "neutro",
                    "recommendation": [],
                    "caution": []
                },
                "veracidade_endereco": {
                    "result": [
                        {
                            "address": {
                                "uf": "RS",
                                "cidade": "PELOTAS",
                                "complemento": null,
                                "numero": "617",
                                "bairro": "LARANJAL",
                                "logradouro": "R VILA DE MAIA 617 - LARANJAL - PELOTAS - RS - 96083000",
                                "ranking": "0",
                                "cep": "96083000"
                            }
                        },
                        {
                            "address": {
                                "uf": "SC",
                                "cidade": "SAO JOSE",
                                "complemento": "PROXIMO AO CALEGARE AP 1",
                                "numero": "25",
                                "bairro": "AREIAS",
                                "logradouro": "R CRISTOVAO RIBEIRO FILHO 25 PROXIMO AO CALEGARE AP 1 - AREIAS - SAO JOSE - SC - 88113814",
                                "ranking": "0",
                                "cep": "88113814"
                            }
                        },
                        {
                            "address": {
                                "uf": "SC",
                                "cidade": "SAO JOSE",
                                "complemento": "AP 202",
                                "numero": "181",
                                "bairro": "AREIAS",
                                "logradouro": "R AUGUSTO JORGE BRUGGEMANN 181 AP 202 - AREIAS - SAO JOSE - SC - 88113823",
                                "ranking": "0",
                                "cep": "88113823"
                            }
                        }
                    ],
                    "icon": "neutro",
                    "recommendation": [],
                    "caution": []
                },
                "veracidade_nome": {
                    "result": "JULIA DA SILVA",
                    "icon": "neutro",
                    "recommendation": [],
                    "caution": []
                },
                "suspeita_obito": {
                    "result": false,
                    "icon": "positivo",
                    "recommendation": [],
                    "caution": []
                },
                "perfil_socioeconomico": {
                    "result": {
                        "estado_civil": null,
                        "valor_locacao": 8600.5,
                        "escolaridade": "ENSINO SUPERIOR",
                        "ocupacao": "ANALISTA DE NEGÓCIOS",
                        "renda": 4079,
                        "vezes": 0.4742747514679379
                    },
                    "icon": "neutro",
                    "recommendation": {
                        "titulo": "Considerando uma locação de imóvel residencial para uso próprio",
                        "observacoes": [
                            "O comprometimento de 0,5 vezes o valor da locação da RENDA PRESUMIDA sistêmica não é compatível com esta locação.",
                            "A renda presumida é apenas uma informação sistêmica baseada em dados estatísticos e de mercado."
                        ]
                    },
                    "caution": []
                },
                "veracidade_nome_mae": {
                    "result": "MARIA DA SILVA",
                    "icon": "neutro",
                    "recommendation": [],
                    "caution": []
                }
            }
        }
    ],
    "parecer": {
        "sintese": [
            {
                "cpf": "68963134393",
                "parecer": [
                    {
                        "parecer": "RENDA INCOMPATÍVEL",
                        "score_fc": 228,
                        "recomendacao": [
                            "RECOMENDA-SE A COMPLEMENTAÇÃO OU A COMPOSIÇÃO DE RENDA COM OUTRO(S) PRETENDENTE(S)."
                        ],
                        "risco": null
                    }
                ],
                "nome": "ANTONIO NUNES",
                "pretendente_id": 572
            },
            {
                "cpf": "52978015918",
                "parecer": [
                    {
                        "parecer": "RENDA INCOMPATÍVEL",
                        "score_fc": 178,
                        "recomendacao": [
                            "RECOMENDA-SE A COMPLEMENTAÇÃO OU A COMPOSIÇÃO DE RENDA COM OUTRO(S) PRETENDENTE(S)."
                        ],
                        "risco": null
                    }
                ],
                "nome": "JULIA DA SILVA",
                "pretendente_id": 573
            }
        ],
        "locacao": {
            "parecer_fiadores": {},
            "parecer_inquilinos": {
                "parecer": "RISCO MÉDIO",
                "aprovados": "Recomenda-se maior cautela na comprovação de renda e na garantia apresentada, para aprovação da locação com o(s) INQUILINO(S): ANTONIO NUNES e JULIA DA SILVA",
                "nao_aprovados": null
            },
            "risco": "Os riscos acima consideram o valor da locação, as rendas declaradas e presumidas, além dos dados apurados no mercado e aplicados à inteligência imobiliária Ficha Certa."
        }
    }
}



### Executar Laudo

**Method:** POST

**URL:** {{url}}/solicitation/:solicitation/report

**Response (OK - 200):**

{
    "message": "Os laudos serão processados e enviados pelo webhook da plataforma quando finalizados"
}

**Response (OK - 200):**

{
	"message": "Solicitação sem laudos pendentes"
}



### Reprocessar Laudo

**Method:** PUT

**URL:** {{url}}/solicitation/:solicitation/report

**Response (OK - 200):**

{
	"message": "Solicitação sem laudos pendentes"
}

**Response (OK - 200):**

{
    "message": "Os laudos serão processados e enviados pelo webhook da plataforma quando finalizados"
}



### Imprimir Laudo

**Method:** GET

**URL:** {{url}}/solicitation/:solicitation/report/print

**Response (OK - 200):**

"https://s3.amazonaws.com/laravel-print/laudo-3634-1576793500.html"



### Download Laudo

**Method:** GET

**URL:** {{url}}/solicitation/:solicitation/report/download



### Criar Solicitação

**Method:** POST

**URL:** {{url}}/solicitation/

**Request Example:**

{
	"produtos": [
		4
	],
	"locacao": {
  		"codigo_imovel": "#C-1234",
  		"aluguel": "5000",
	  	"condominio": "3500",
	  	"iptu": "100.50",
	  	"tipo_imovel": "RESIDENCIAL",
	  	"endereco": {
			"cep": "20751380",
			"logradouro": "Rua Xisto Baía",
			"bairro": "Piedade",
			"cidade": "Rio de Janeiro",
			"uf": "RJ",
			"numero": "30",
			"complemento": "apt 300"
  		}
	},
	"pretendente": {
		"tipo_pretendente": "OUTROS",
		"razao_social": "Nome da Empresa",
		"cnpj": "{{random_cnpj}}"
	}
}

**Response (OK - 200):**

{
    "id": 219,
    "message": "Solicitação cadastrada"
}

**Response (Unprocessable Entity (WebDAV) (RFC 4918) - 422):**

{
    "message": {
        "pretendente.tipo_pretendente": [
            "O campo pretendente.tipo_pretendente é obrigatório."
        ]
    }
}

**Response (None - None):**



### Lista de Solicitação

**Method:** GET

**URL:** {{url}}/solicitation/?perPage=&page=&sort&start_date=&end_date=&filter=

**Response (OK - 200):**

{
    "pagination": {
        "per_page": 25,
        "current_page": 1,
        "last_page": 1,
        "from": 1,
        "to": 2,
        "itens_page": 2,
        "total": 2
    },
    "data": [
        {
            "id": 126,
            "status": "FINALIZADO",
            "data_criacao": "2019-03-20 16:10:02",
            "cliente_id": 142,
            "cliente_nome": "CLIENTE JOÃO LTDA.",
            "pretendentes": [
                {
                    "id": 259,
                    "tipo_pretendente": "OUTROS",
                    "razao_social": "HOMERO DE ARAUJO SILVA",
                    "cnpj": "38646762000132",
                    "produtos": [
                        {
                            "id": 4,
                            "nome": "FC EMPRESA",
                            "status": "CONCLUIDO",
                            "data": "2019-03-20 16:10:02",
                            "data_atualizacao": "2019-03-20 16:10:02"
                        }
                    ]
                },
                {
                    "id": 260,
                    "tipo_pretendente": "INQUILINO",
                    "nome": "VALDIR JOSE DA COSTA",
                    "cpf": "13421964572",
                    "data_nascimento": "1967-07-30",
                    "nome_mae": "ELZA SILVA",
                    "residir": false,
                    "participante": true,
                    "produtos": [
                        {
                            "id": 1,
                            "nome": "FC ANALISE",
                            "status": "CONCLUIDO",
                            "data": "2019-03-20 16:10:30",
                            "data_atualizacao": "2019-03-20 16:10:30"
                        }
                    ],
                    "renda": {
                        "principal": {
                            "origem": 3,
                            "titulo": "Funcionário Público (CLT)",
                            "valor": "5034.31",
                            "documentos": []
                        },
                        "outra": {
                            "origem": 4,
                            "titulo": "Empresário",
                            "valor": "5034.31",
                            "documentos": []
                        },
                        "confirmada": [],
                        "analises": []
                    }
                }
            ],
            "locacao": {
                "codigo_imovel": "I-1234",
                "aluguel": "2300.00",
                "condominio": "400.00",
                "iptu": "90.00",
                "tipo_imovel": "RESIDENCIAL",
                "endereco": [
                    {
                        "logradouro": "Rua Marques de Sao Vicente",
                        "numero": "512",
                        "complemento": null,
                        "bairro": "Gávea",
                        "cidade": "Rio de Janeiro",
                        "uf": "RJ",
                        "cep": "22451040"
                    }
                ]
            }
        },
        {
            "id": 121,
            "status": "FINALIZADO",
            "data_criacao": "2019-03-19 17:26:33",
            "cliente_id": 142,
            "cliente_nome": "CLIENTE JOÃO LTDA.",
            "pretendentes": [
                {
                    "id": 236,
                    "tipo_pretendente": "INQUILINO",
                    "nome": "FABIO MACHADO",
                    "cpf": "39283375483",
                    "data_nascimento": "1976-09-12",
                    "nome_mae": null,
                    "residir": true,
                    "participante": true,
                    "produtos": [
                        {
                            "id": 1,
                            "nome": "FC ANALISE",
                            "status": "CONCLUIDO",
                            "data": "2019-03-19 17:26:33",
                            "data_atualizacao": "2019-03-19 17:26:33"
                        }
                    ],
                    "renda": {
                        "principal": {
                            "origem": 3,
                            "titulo": "Funcionário Público (CLT)",
                            "valor": "5034.31",
                            "documentos": []
                        },
                        "outra": {
                            "origem": 4,
                            "titulo": "Empresário",
                            "valor": "5034.31",
                            "documentos": []
                        },
                        "confirmada": [],
                        "analises": []
                    }
                },
                {
                    "id": 237,
                    "tipo_pretendente": "FIADOR",
                    "nome": "SUSAN OLIVEIRA",
                    "cpf": "87828884265",
                    "data_nascimento": "1970-04-16",
                    "nome_mae": "JUDITH DA COSTA",
                    "residir": false,
                    "participante": false,
                    "produtos": [
                        {
                            "id": 1,
                            "nome": "FC ANALISE",
                            "status": "CONCLUIDO",
                            "data": "2019-03-19 17:33:37",
                            "data_atualizacao": "2019-03-19 17:33:37"
                        }
                    ],
                    "renda": {
                        "principal": {
                            "origem": 3,
                            "titulo": "Funcionário Público (CLT)",
                            "valor": "5034.31",
                            "documentos": []
                        },
                        "outra": {
                            "origem": 4,
                            "titulo": "Empresário",
                            "valor": "5034.31",
                            "documentos": []
                        },
                        "confirmada": [],
                        "analises": []
                    }
                }
            ],
            "locacao": {
                "codigo_imovel": "c-5555",
                "aluguel": "2000.00",
                "condominio": "660.11",
                "iptu": "300.00",
                "tipo_imovel": "RESIDENCIAL",
                "endereco": [
                    {
                        "logradouro": "Rua Senador Muniz Freire",
                        "numero": "1710",
                        "complemento": "5001",
                        "bairro": "Vila Isabel",
                        "cidade": "Rio de Janeiro",
                        "uf": "RJ",
                        "cep": "20541040"
                    }
                ]
            }
        }
    ]
}



### Detalhe da Solicitação

**Method:** GET

**URL:** {{url}}/solicitation/:solicitation

**Response (OK - 200):**

{
    "data": {
        "id": 121,
        "status": "FINALIZADO",
        "data_criacao": "2019-03-19 17:26:33",
        "cliente_id": 142,
        "cliente_nome": "CLIENTE JOÃO LTDA.",
        "locacao": {
            "codigo_imovel": "C-5555",
            "aluguel": "2000.00",
            "condominio": "660.11",
            "iptu": "300.00",
            "tipo_imovel": "RESIDENCIAL",
            "endereco": [
                {
                    "logradouro": "Rua Senador Muniz Freire",
                    "numero": "1700",
                    "complemento": "7001",
                    "bairro": "Vila Isabel",
                    "cidade": "Rio de Janeiro",
                    "uf": "RJ",
                    "cep": "20541040"
                }
            ]
        },
        "pretendentes": [
            {
                "id": 236,
                "tipo_pretendente": "OUTROS",
                "razao_social": "FABIO MACHADO SILVA",
                "cnpj": "38646762000132",
                "produtos": [
                    {
                        "id": 4,
                        "nome": "FC EMPRESA",
                        "status": "CONCLUIDO",
                        "data": "2019-03-19 17:26:33",
                        "data_atualizacao": "2019-03-19 17:26:33"
                    }
                ]
            },
            {
                "id": 237,
                "tipo_pretendente": "FIADOR",
                "nome": "SUSAN MOREIRA",
                "cpf": "83686171384",
                "data_nascimento": "1989-10-20",
                "nome_mae": "JUDITH COSTA",
                "residir": false,
                "participante": false,
                "produtos": [
                    {
                        "id": 1,
                        "nome": "FC ANALISE",
                        "status": "CONCLUIDO",
                        "data": "2019-03-19 17:33:37",
                        "data_atualizacao": "2019-03-19 17:33:37"
                    }
                ],
                "renda": {
                    "principal": {
                        "origem": 4,
                        "titulo": "Empresário",
                        "valor": "5100.00"
                    },
                    "outra": {
                        "origem": 1,
                        "titulo": "Outros / Não informado",
                        "valor": "1000.00"
                    }
                }
            }
        ]
    }
}



### Editar Solicitação

**Method:** PUT

**URL:** {{url}}/solicitation/:solicitation

**Request Example:**

{
	"codigo_imovel": "C-1234",
  	"aluguel": "5000",
	"condominio": "3500",
	"iptu": "100.50",
	"tipo_imovel": "RESIDENCIAL",
	"endereco": {
		"cep": "20751380",
		"logradouro": "Rua Xisto Baía",
		"bairro": "Piedade",
		"cidade": "Rio de Janeiro",
		"uf": "RJ",
		"numero": "30",
		"complemento": "apt 300"
  	}
}

**Response (OK - 200):**

{
    "message": "Locação Atualizada"
}

**Response (Unprocessable Entity - 422):**

{
    "message": "Não é possível atualizar uma locação para tipo de imóvel NÃO RESIDENCIAL quando na mesma existe pretendente do tipo FIADOR DE ESTUDANTE"
}



### Remover Solicitação

**Method:** DELETE

**URL:** {{url}}/solicitation/:solicitation

**Response (OK - 200):**

{
    "message": "Solicitação, pretendentes e dados relacionados, removidos"
}

**Response (Unprocessable Entity - 422):**

{
    "message": "Uma solicitação somente pode ser removida, quando ainda não solicitada a geração do laudo para nenhum de seus pretendentes"
}



### Criar Novo Pretendente

**Method:** POST

**URL:** {{url}}/solicitation/:solicitation/applicant/

**Request Example:**

{
	"produtos": [
		4
	],
	"pretendente": {
		"tipo_pretendente": "OUTROS",
		"razao_social": "Nome da Empresa",
		"cnpj": "38646762000132"
	}
}

**Response (OK - 200):**

{
    "id": 571,
    "message": "Pretendente cadastrado"
}



### Detalhe do Pretendente

**Method:** GET

**URL:** {{url}}/solicitation/:solicitation/applicant/:applicant

**Response (OK - 200):**

{
    "data": {
        "id": 219,
        "status": "PENDENTE",
        "data_criacao": "2019-07-15 13:45:02",
        "cliente_id": 142,
        "cliente_nome": "CLIENTE JOÃO LTDA.",
        "locacao": {
            "codigo_imovel": "C-1234",
            "aluguel": "5000.00",
            "condominio": "3500.00",
            "iptu": "100.50",
            "tipo_imovel": "RESIDENCIAL",
            "endereco": [
                {
                    "logradouro": "Rua Xisto Baía",
                    "numero": "30",
                    "complemento": "apt 300",
                    "bairro": "Piedade",
                    "cidade": "Rio de Janeiro",
                    "uf": "RJ",
                    "cep": "20751380"
                }
            ]
        },
        "pretendente": [
            {
                "id": 571,
                "tipo_pretendente": "OUTROS",
                "razao_social": "NOME DA EMPRESA",
                "cnpj": "38646762000132",
                "produtos": [
                    {
                        "id": 4,
                        "nome": "FC EMPRESA",
                        "status": "INCLUIDO",
                        "data": "2019-07-15 14:23:18",
                        "data_atualizacao": "2019-07-15 14:23:18"
                    }
                ]
            }
        ]
    }
}



### Editar Pretendente

**Method:** PUT

**URL:** {{url}}/solicitation/:solicitation/applicant/:applicant

**Request Example:**

{
	"pretendente": {
		"tipo_pretendente": "OUTROS",
		"razao_social": "Nome da Empresa",
		"cnpj": "38646762000132"
	}
}

**Response (OK - 200):**

{
    "message": "Pretendente Atualizado"
}



### Remover Pretendente

**Method:** DELETE

**URL:** {{url}}/solicitation/:solicitation/applicant/:applicant

**Response (OK - 200):**

{
    "message": "Pretendente removido da solicitação"
}

**Response (Unprocessable Entity - 422):**

{
    "message": "Um Pretendente somente pode ser removido, quando ainda não foi solicitada a geração do laudo para nenhum de seus produtos"
}

