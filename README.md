# PHP app/lib blueprint

[![Latest Version](https://img.shields.io/packagist/v/korchasa/blueprint.svg?style=flat-square)](https://packagist.org/packages/korchasa/blueprint)
[![Build Status](https://travis-ci.org/korchasa/blueprint.svg?style=flat-square)](https://travis-ci.org/korchasa/blueprint)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.0-8892BF.svg?style=flat-square)](https://php.net/)

Structure, code style, static analysis, PHPUnit, travis-ci template.

Create project:
```bash
composer create-project korchasa/blueprint <project_dir>
```

Dev usage:
```bash
composer run-script check-loop --timeout=0 # check everything every 10 secs
```

Other scripts:
```bash
composer run-script style # check code style with code_sniffer
composer run-script style-fix # fix code style
composer run-script analyze # static analysis
composer run-script unit # run unit tests
composer run-script check # style && analyze && unit
``` 
