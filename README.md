MedLabs
===

Custom WordPress theme built from Underscores for EDUCATIONAL as well as DEMONSTRATING purposes. All content on this website is fictitious and should not be taken seriously. This theme will be used purely as portfolio work for demonstration purposes.

Currently copying styles from www.fastmed.com to get the project off the ground. Attempting to recreate the theme by changing the color scheme and various features towards the end. I'm not creating a child theme purely for the sake of learning to create custom WordPress themes from SCRATCH using Underscores.

* NPM as the package manager.
* Gulp as a task-runner.
* Extensive SASS partial separation.
* Navigation script at `js/navigation.js` used to provide seamless support on all devices.
* SVG logo for high detail branding and quality.
* Various customizer options to make the user experience unique.
* Online check-in coming soon.


Getting Started (personal reminder)
---------------

In order to build this project do the following:

1. Clone this repository.
2. Run `npm install`, which will run `gulp copy-assets` automatically to capture assets.
3. Import sql file at `sql/wordpress.sql` into your existing WordPress installation (change `$table_prefix` in your `wp-config.php` file to `medlabs_`).
3. Run gulp `gulp`.

THIS PROJECT IS STILL IN PROGRESS.
