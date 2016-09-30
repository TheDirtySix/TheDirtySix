#TheDirtySix






## WordPress BASE ON "Skeleton"

* More easy to work on WP


## Now What?

* WordPress is in it's own folder `/wp`.
* Web root only has two folders `/wp` and `/content`
* `wp-config.php` in the root (because it can't be in `/wp/`)


## How to install
After downloading you can continue to install WordPress
1) Copy `local-config.sample.php` and rename it to `local-config.php`
2) Add the database constants and the domain (e.g "http://localhost/TheDirtySix")
3) In `wp-config.php` Edit the `$table_prefix`
4) add the `*_KEY` constants which can be generated [here](https://api.wordpress.org/secret-key/1.1/salt)
5) open your website and continue with the famous 5 minute install.


## Guides

* Delete and add new database if any error occurs
* Wordpress version 4.6.1
* Ready to Start


## Workflow

1.Pull
2.Create new branch
3.Push to new branch
4.Commit branch
5.Pull request
