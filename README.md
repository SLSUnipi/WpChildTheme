# Libre Theme
This is a child theme based on Bootstrap 4, and Understrap WordPress starter theme.
"Libre" means freedom, that expresses this theme's goals: An easy to use theme that will give site developers the ability to use reusable widgets made in the Bootstrap way without assuming things or requiring "premium versions", a theme that will respect not only  the WordPress and the Bootstrap's  way, but the site creator as well, and it will not require extra plugins for simple utilities.

## How to use this child theme.
Since its a child theme of Understrap:
1) You need to have the Understrap theme installed on your WordPress installation.
then...
2) Just clone the repo into the `wp-content/themes` directory, or download it as a zip and add it through WordPress.

You can find Understrap here
[1] https://understrap.com/
...or search it and  install it directly through WordPress themes.

## How to modify this theme!!!.
Since this is a child theme of Understrap it uses the Understrap's official child template, and has some development dependancies that are not included into the repo. therefore after you clone the repo you need to:

1) Have installed NodeJS, npm, gulp (the latest two are using NodeJS), we use npm to manage our development dependancies, and gulp to compile sass files into css and other utilities.

2) Switch to the theme's directory and run 
 - `$ npm install`to install dependancies and after that run 
 - `$ gulp copy-assets` to load the configurations to gulp 
 - `$ gulp watch` to track changes on sass files, and automatically recompile and minify/unglify them.

3) You add sass styles at `sass/theme/` ,
- modify  `_child_theme_variables.scss` to overwrite Bootstrap's global variables. [2]
- add your own sass styles on `_child_theme.scss`.
- your changes will recompile the `css/child-theme.css` and `css/child-theme.min.css` appropriately. the latest is what is the final stylesheet that its loaded.

More on Bootstrap theming
[2] https://getbootstrap.com/docs/4.0/getting-started/theming/

## Why Understrap.
Understrap provides an out-of-the-box development enviroment using the latest standarts. It is also a Bootstrap 4 theme, which means it comes with all the Bootstrap goodies (and we love Bootstrap goodies :) ). What is more, by being a starter theme means it provides basic utilities and basic boilerplate setup and a basic starter layout, without getting in your way. What is more we chose to make it into a child theme in order to get any updates of Understrap.

Finally it is completely open source.

More on the Understrap Project:
https://github.com/understrap

