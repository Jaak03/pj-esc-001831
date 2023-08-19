# pj-esc-001831 #
Simple escrow service for local makers.

## 📄 Documentation ##
You can find the documentation for this project [here](https://tri2be.notion.site/Documentation-61ee720b44bd4719b5f81f618730dfc4?pvs=4).

The readme file is for developers to get it up and running so that they can contribute to the project. The documentation is where user-related info will be shared.

## 🚀 Getting Started ##
The repo is using Laravel Sail to run the project. You can find the documentation for Laravel Sail [here](https://laravel.com/docs/8.x/sail).

```shell
# Start the local development environment.
sail up -d
```

You can run a list of commands from inside the docker container, an example of this would be starting the Vite 
service insided the container.

Other services that I know of include:
* artisan
* composer
* yarn
* php

```shell
# Start Vite's development server.
sail yarn dev
```

There is a `.rc` file in the root of the project that will allow you to run the commands without having to type 
`sail`. To make use of this you will have to `source` the file. Have a look in the file to see what aliases and 
exports are defined at a given time.

```shell
# Source the .rc file.
source .rc
```
