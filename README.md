# wordpress-laravel-knowledgebase
A project to link WordPress posts that belong to a custom post type Knowledegebase, that contains categories and tags, to a Laravel Nova project where posts may be edited.

Setup

In WordPress, load custom field type UI

Then create a new custom field called Knowledgebase(s)

Then create new taxonomy 'knowledgebase_category(ies)' and 'knowledgebase_tag(s)'

Use

php artisan whmcs:migrate-kb

