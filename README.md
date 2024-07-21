# api-platform-core-6485

## What's this?

This is an example repository for [api-platform/core#6485](https://github.com/api-platform/core/pull/6485).

## Installation

```shell
$ git clone git@github.com:ttskch/api-platform-core-6485.git
$ cd api-platform-core-6485
$ composer install
```

## Usage

```shell
$ git checkout c46bd8d # test: 💍 reproduce the test failure with `assertMatchesResourceItemJsonSchema()`
$ composer test # fail

$ git checkout 474feef # feat: 🎸 update api-platform-core
$ composer test # pass
```
