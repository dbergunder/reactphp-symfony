# Symfony 4 + ReactPHP

Demo of a simple Symfony 4 application running in ReactPHP

Slides: https://www.slideshare.net/DavidBergunder/reactphp-symfony

### References
- [Install Symfony 4 and Flex](https://symfony.com/doc/current/setup.html)
- [ReactPHP documentation](https://reactphp.org/)
  - [ReactPHP Github](https://github.com/reactphp/react)
- [Conversion between request/response types](http://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/index.html#psr-7-support)
  - [HttpFoundation Bridge](https://github.com/symfony/psr-http-message-bridge)
  - [Zend Diactoros](https://github.com/zendframework/zend-diactoros)

### Wired Up
Executable PHP command in [bin/react](/bin/react)
```bash
$ bin/react
```

### Caveats
- Convert HttpFoundation Request/Response between Psr Request/Response
- File uploads/transfers
- Symfony debug and profiling enabled means memory leaks!