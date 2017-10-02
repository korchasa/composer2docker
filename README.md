# Generate Dockerfile by composer.* files

[![Build Status](https://travis-ci.org/korchasa/composer2docker.svg?style=flat-square)](https://travis-ci.org/korchasa/composer2docker)
[![Docker Pulls](https://img.shields.io/docker/pulls/korchasa/composer2docker.svg?style=flat-square)](https://hub.docker.com/r/korchasa/composer2docker/)

## Usage

```bash
docker run --rm -v "$(pwd)":/work korchasa/composer2docker > Dockerfile
```