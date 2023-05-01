<?php

return [
    /*
      |--------------------------------------------------------------------------
      | Validation Language Lines
      |--------------------------------------------------------------------------
      |
      | The following language lines contain the default error messages used by
      | the validator class. Some of these rules have multiple versions such
      | as the size rules. Feel free to tweak each of these messages here.
      |
     */

    'accepted' => 'O campo :attribute deve ser aceito.',
    'active_url' => 'O campo :attribute não é uma URL válida.',
    'after' => 'O campo :attribute deve ser uma data posterior a :date.',
    'after_or_equal' => 'O campo :attribute deve ser uma data superior ou igual a :date.',
    'alpha' => 'O campo :attribute deve ser apenas letras.',
    'alpha_dash' => 'O campo :attribute só pode conter letras, números e traços.',
    'alpha_num' => 'O campo :attribute só pode conter letras e números.',
    'array' => 'O campo :attribute deve conter um array.',
    'before' => 'O campo :attribute deve conter uma data anterior a :date.',
    'before_or_equal' => 'O campo :attribute deve conter uma data inferior ou igual a :date.',
    'between' => [
        'numeric' => 'O campo :attribute deve conter um número entre :min e :max.',
        'file' => 'O campo :attribute deve conter um arquivo de :min a :max kilobytes.',
        'string' => 'O campo :attribute deve conter entre :min a :max caracteres.',
        'array' => 'O campo :attribute deve conter de :min a :max itens.',
    ],
    'boolean' => 'O campo :attribute deve conter o valor verdadeiro ou falso.',
    'confirmed' => 'A confirmação para o campo :attribute não coincide.',
    'date' => 'O campo :attribute não contém uma data válida.',
    'date_format' => 'A data informada para o campo :attribute não respeita o formato :format.',
    'different' => 'Os campos :attribute e :other devem conter valores diferentes.',
    'digits' => 'O campo :attribute deve conter :digits dígitos.',
    'digits_between' => 'O campo :attribute deve conter entre :min a :max dígitos.',
    'dimensions' => 'O valor informado para o campo :attribute não é uma dimensão de imagem válida.',
    'distinct' => 'O campo :attribute contém um valor duplicado.',
    'email' => 'O campo :attribute não contém um endereço de e-mail válido.',
    'exists' => 'O valor selecionado para o campo :attribute é inválido.',
    'file' => 'O campo :attribute deve conter um arquivo.',
    'filled' => 'O campo :attribute é obrigatório.',
    'gt' => [
        'numeric' => 'O campo :attribute deve ser maior que :value.',
        'file' => 'O campo :attribute deve ser maior que :value kilobytes.',
        'string' => 'O campo :attribute deve ser maior que :value caracteres.',
        'array' => 'O campo :attribute deve ter mais que :value items.',
    ],
    'gte' => [
        'numeric' => 'O campo :attribute deve ser maior ou igual a :value.',
        'file' => 'O campo :attribute deve ser maior ou igual a :value kilobytes.',
        'string' => 'O campo :attribute deve ser maior ou igual a :value caracteres.',
        'array' => 'O campo :attribute deve ter :value items ou mais.',
    ],
    'image' => 'O campo :attribute deve conter uma imagem.',
    'in' => 'O campo :attribute não contém um valor válido.',
    'in_array' => 'O campo :attribute não existe em :other.',
    'integer' => 'O campo :attribute deve conter um número inteiro.',
    'ip' => 'O campo :attribute deve conter um IP válido.',
    'ipv4' => 'O campo :attribute deve conter um IPv4 válido.',
    'ipv6' => 'O campo :attribute deve conter um IPv6 válido.',
    'json' => 'O campo :attribute deve conter uma string JSON válida.',
    'lt' => [
        'numeric' => 'O campo :attribute deve ser menor que :value.',
        'file' => 'O campo :attribute deve ser menor que :value kilobytes.',
        'string' => 'O campo :attribute deve ser menor que :value caracteres.',
        'array' => 'O campo :attribute deve ter menos do que :value items.',
    ],
    'lte' => [
        'numeric' => 'O campo :attribute deve ser menor ou igual a :value.',
        'file' => 'O campo :attribute deve ser menor ou igual a :value kilobytes.',
        'string' => 'O campo :attribute deve ser menor ou igual a :value caracteres.',
        'array' => 'O campo :attribute não deve ter mais do que :value items.',
    ],
    'max' => [
        'numeric' => 'O campo :attribute não pode conter um valor superior a :max.',
        'file' => 'O campo :attribute não pode conter um arquivo com mais de :max kilobytes.',
        'string' => 'O campo :attribute não pode conter mais de :max caracteres.',
        'array' => 'O campo :attribute deve conter no máximo :max itens.',
    ],
    'mimes' => 'O campo :attribute deve conter um arquivo do tipo: :values.',
    'mimetypes' => 'O campo :attribute deve conter um arquivo do tipo: :values.',
    'min' => [
        'numeric' => 'O campo :attribute deve conter um número superior ou igual a :min.',
        'file' => 'O campo :attribute deve conter um arquivo com no mínimo :min kilobytes.',
        'string' => 'O campo :attribute deve conter no mínimo :min caracteres.',
        'array' => 'O campo :attribute deve conter no mínimo :min itens.',
    ],
    'not_in' => 'O campo :attribute contém um valor inválido.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'O campo :attribute deve conter um valor numérico.',
    'present' => 'O campo :attribute deve estar presente.',
    'regex' => 'O formato do valor informado no campo :attribute é inválido.',
    'required' => 'O campo :attribute é obrigatório.',
    'required_if' => 'O campo :attribute é obrigatório quando o valor do campo :other é igual a :value.',
    'required_unless' => 'O campo :attribute é obrigatório a menos que :other esteja presente em :values.',
    'required_with' => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_with_all' => 'O campo :attribute é obrigatório quando um dos :values está presente.',
    'required_without' => 'O campo :attribute é obrigatório quando :values não está presente.',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum dos :values está presente.',
    'same' => 'Os campos :attribute e :other devem conter valores iguais.',
    'size' => [
        'numeric' => 'O campo :attribute deve conter o número :size.',
        'file' => 'O campo :attribute deve conter um arquivo com o tamanho de :size kilobytes.',
        'string' => 'O campo :attribute deve conter :size caracteres.',
        'array' => 'O campo :attribute deve conter :size itens.',
    ],
    'string' => 'O campo :attribute deve ser uma string.',
    'timezone' => 'O campo :attribute deve conter um fuso horário válido.',
    'unique' => 'O valor informado para o campo :attribute já está em uso.',
    'uploaded' => 'Falha no Upload do arquivo :attribute.',
    'url' => 'O formato da URL informada para o campo :attribute é inválido.',
    /*
      |--------------------------------------------------------------------------
      | Custom Validation Language Lines
      |--------------------------------------------------------------------------
      |
      | Here you may specify custom validation messages for attributes using the
      | convention "attribute.rule" to name the lines. This makes it quick to
      | specify a specific custom language line for a given attribute rule.
      |
     */
    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
    'values' => [
        'civil_status' => [
            'married' => 'casado',
            'separated' => 'separado',
            'single' => 'solteiro',
            'divorced' => 'divorciado',
            'widower' => 'viúvo',
        ]
    ],
    /*
      |--------------------------------------------------------------------------
      | Custom Validation Attributes
      |--------------------------------------------------------------------------
      |
      | The following language lines are used to swap attribute place-holders
      | with something more reader friendly such as E-Mail Address instead
      | of "email". This simply helps us make messages a little cleaner.
      |
     */
    'attributes' => [
        'address' => 'endereço',
        'age' => 'idade',
        'body' => 'conteúdo',
        'city' => 'cidade',
        'country' => 'país',
        'date' => 'data',
        'day' => 'dia',
        'description' => 'descrição',
        'excerpt' => 'resumo',
        'first_name' => 'primeiro nome',
        'gender' => 'gênero',
        'hour' => 'hora',
        'last_name' => 'sobrenome',
        'message' => 'mensagem',
        'minute' => 'minuto',
        'mobile' => 'celular',
        'month' => 'mês',
        'name' => 'nome',
        'password_confirmation' => 'confirmação da senha',
        'password' => 'senha',
        'phone' => 'telefone',
        'second' => 'segundo',
        'sex' => 'sexo',
        'state' => 'estado',
        'subject' => 'assunto',
        'text' => 'texto',
        'time' => 'hora',
        'title' => 'título',
        'username' => 'usuário',
        'year' => 'ano',
        // Person
        'document' => 'CPF',
        'document_secondary' => 'RG',
        'document_secondary_complement' => 'órgão expedidor',
        'date_of_birth' => 'data de nascimento',
        'place_of_birth' => 'naturalidade',
        'occupation' => 'profissão',
        'income' => 'renda',
        'company_work' => 'empresa',
        'civil_status' => 'estado civil',
        'cover' => 'foto',
        // Address
        'zipcode' => 'CEP',
        'street' => 'rua',
        'number' => 'número',
        'neighborhood' => 'bairro',
        // Contact
        'telephone' => 'telefone',
        'cell' => 'celular',
        //Access
        'email' => 'e-mail',
        // Spouse
        'spouse_name' => 'nome do cônjuge',
        'spouse_document' => 'CPF do cônjuge',
        'spouse_document_secondary' => 'RG do cônjuge',
        'spouse_document_secondary_complement' => 'órgão expedidor do cônjuge',
        'spouse_date_of_birth' => 'data de nascimento do cônjuge',
        'spouse_place_of_birth' => 'naturalidade do cônjuge',
        'spouse_occupation' => 'profissão do cônjuge',
        'spouse_income' => 'renda do cônjuge',
        'spouse_company_work' => 'empresa do cônjuge',
        // Company
        'social_name' => 'razão social',
        'alias_name' => 'nome fantasia',
        'document_company' => 'CNPJ',
        'document_company_secondary' => 'inscrição estadual',
        // Contracts
        'owner' => 'proprietário',
        'acquirer' => 'adquirente',
        'property' => 'imóvel',
        'start_at' => 'data de início',
        // PROPERTY
        'user' => 'usuário',
        'tribute' => 'IPTU',
        'sale_price' => 'preço de venda',
        'rent_price' => 'preço de locação',
        'sale' => 'venda',
        'rent' => 'locação',
        'on' => 'selecionado',
        'condominium' => 'condomínio',
        'bedrooms' => 'quartos',
        'suites' => 'suítes',
        'bathrooms' => 'banheiros',
        'rooms' => 'salas',
        'garage' => 'garagem',
        'garage_covered' => 'garagem coberta',
        'area_total' => 'área total',
        'area_util' => 'área útil',
        'type_of_communion' => 'tipo de comunhão',
        'broker' => 'corretor',
        'creci' => 'CRECI',
        'commission' => 'comissão',
        'max_budget' => 'orçamento máximo',
        'fgts' => 'FGTS',
        'entry_value' => 'valor de entrada',
        'bank_account' => 'dados bancários',
        'value' => 'valor',
        'date_of_sale' => 'data da venda',
        'init_date' => 'data de início',
        'end_date' => 'data de término',
    ],
];
