# phtfao/panako

## Execução
Este é um pacote com o código fonte principal.
Sua execução depende do esqueleto de algum framework.

Para testar o aplicativo, clone o esqueleto do `Lumen` pré-configurado:
```
git clone git@github.com:phtfao/lumen-skeleton.git panako
```
Em seguida, entre no diretório clonado e execute o `Docker`

```
docker compose up
```
Este comando construirá as imagens e subirá os containers necessário para rodar o aplicativo.
Após subir os container, rode o script de configuração (dentro do contaiber):
```
docker exec -it panako-php-fpm-1 sh start.sh 
```

Para executar os testes:
```
docker exec -it panako-php-fpm-1 composer test
```

Para execução em ambiente sem o docker os requisitos são:
- PHP 8.1
- Estensão SQLite
- Composer 2.4
<!-- pagebreak -->


### Documentação
[http://localhost:24000/docs.html](localhost:24000/docs.html).

A api está disponível em [http://localhost:24000/transfer](http://localhost:24000/transfer).
