# Generate Dockerfile by composer.* files

[![Latest Version](https://img.shields.io/packagist/v/korchasa/composer2docker.svg?style=flat-square)](https://packagist.org/packages/korchasa/composer2docker)
[![Build Status](https://travis-ci.org/korchasa/composer2docker.svg?style=flat-square)](https://travis-ci.org/korchasa/composer2docker)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.0-8892BF.svg?style=flat-square)](https://php.net/)

## Usage

```bash
docker run --rm -v "$(pwd)":/work korchasa/composer2docker > Dockerfile
```