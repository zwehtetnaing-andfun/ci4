
### Project Setup and Configuration

### 1. Installing the Project:

To install CodeIgniter 4, run the following command in your terminal:  

```bash
composer create-project codeigniter4/appstarter project-name
```
  

#### 2. Running the Project:

Start the project server by running:  
```bash  
php spark serve
```
-   This will launch the server and you can access the project at `http://localhost:8080`.
    

  

#### 3. Database Configuration:

Configure your database in `app/Config/Database.php`. Example configuration:  
 ```php 
public array $default = [

'DSN' => '',

'hostname' => 'localhost',

'username' => 'root',

'password' => '',

'database' => 'myci4',

'DBDriver' => 'MySQLi',

// other options

];
```
-   Set hostname, username, password, and database according to your database setup.
    

#### 4. Making Migrations:

To generate a migration file, run:  
```bash
php spark make:migration articles
```
-   This will create a migration file in `app/Database/Migrations`.
    

Example migration file (Articles migration):  
 
 ```php
 
 <?php 
 
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;


class Articles extends Migration
{
	public function up(){

			$this->forge->addField([

				'id' => [

					'type' => 'INT',

					'constraint' => 5,

					'unsigned' => true,

					'auto_increment' => true,

				],

				'title' => [

					'type' => 'VARCHAR',

					'constraint' => '100',

				],

				'content' => [

					'type' => 'TEXT',

					'null' => true,

				],

			]);

			$this->forge->addKey('id', true); // Primary Key

			$this->forge->createTable('articles'); // Create the table

	}

  

	public function down(){
			$this->forge->dropTable('articles'); // Drop the table
	}

}
```
  

Running Migrations: To apply the migration and create the table:  
```bash
php spark migrate
```
  

#### 5. Creating a Model:

Generate the model file using:  
 ```bash 
php spark make:model Article
```
-   This creates the `Article.php` model file in `app/Models`.
    

Example Article model:  

```php

<?php

namespace App\Models;

  

use CodeIgniter\Model;

  

class Article extends Model

{

protected $table = 'articles';

protected $primaryKey = 'id';

protected $useAutoIncrement = true;

protected $returnType = 'array';

protected $allowedFields = ['title', 'content'];

  

protected $useTimestamps = false;

protected $dateFormat = 'datetime';

protected $createdField = 'created_at';

protected $updatedField = 'updated_at';

  

// Validation Rules

protected $validationRules = [];

protected $skipValidation = false;

}
```
-   Key Points:
    

-   `$table`: Defines the database table.
    
-   `$primaryKey`: Specifies the primary key of the table.
    
-   `$allowedFields`: Specifies which fields can be inserted/updated.
    
-   `$useTimestamps`: Controls automatic timestamps (set false if not used).
    

  

### Controller

  

Generate the controller file using:  
```bash  
php spark make:controller Article
```

#### Location:

`app/Controllers/Article.php`

----------

#### Methods:

****1. ` index()`****
    

-   Displays all articles.
    
-   Route: `/articles`
    

  ```php
  
public function index() {

$articles = (new \App\Models\Article())->findAll();

return view('articles/index', ['articles' => $articles]);

}
```
****2.  `create()`****
    

-   Shows the article creation form.
    
-   Route: `/articles/create`
    

```php
public function create() {

return view('articles/create');

}
```
****3.  `store()`****
    

-   Saves a new article.
    
-   Route: `/articles/store` (POST)
    

```php
public function store() {

(new \App\Models\Article())->insert([

'title' => $this->request->getPost('title'),

'content' => $this->request->getPost('content')

]);

return redirect()->to('/articles');

}
```
****4.  `edit($id)`****
    

-   Displays the edit form for a specific article.
    
-   Route: /articles/edit/{id}
    

```php 
public function edit($id) {

$article = (new \App\Models\Article())->find($id);

return view('articles/edit', ['article' => $article]);

}
```
****5.  `update($id)`****
    

-   Updates an existing article.
    
-   Route: `/articles/update/{id}` (POST)
    

```php
public function update($id) {

(new \App\Models\Article())->update($id, [

'title' => $this->request->getPost('title'),

'content' => $this->request->getPost('content')

]);

return redirect()->to('/articles');

}
```
****6.  `delete($id)`****
    

-   Deletes an article.
    
-   Route: `/articles/delete/{id}`
    

```php
public function delete($id) {

(new \App\Models\Article())->delete($id);

return redirect()->to('/articles');

}
```
---

## Routes Configuration

### File Location:

`app/Config/Routes.php`


### Routes Definitions:

  
```php
$routes->get('/articles', 'Article::index'); // Show all articles

$routes->get('/articles/create', 'Article::create'); // Show create form

$routes->post('/articles/store', 'Article::store'); // Save new article

$routes->get('/articles/edit/(:num)', 'Article::edit/$1'); // Show edit form for specific article

$routes->post('/articles/update/(:num)', 'Article::update/$1'); // Update article

$routes->post('/articles/delete/(:num)', 'Article::delete/$1'); // Delete article
```
  
  ---  
  

## View & Layouts

#### 1. Layout (`app/Views/layouts/app.php`)

This layout file provides a common HTML structure for all pages, including Bootstrap styles and scripts. It uses the `<?= $this->renderSection('content') ?>` directive to inject content from child views.

  
```html
<!doctype html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CI 4</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <?= $this->renderSection('content') ?> <!-- Dynamic content section -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
```
  

----------

#### 2. Index Page (`app/Views/articles/index.php`)

The index page lists all articles and provides options to edit or delete them. It extends the `app.php` layout.

  
```php
<?= $this->extend('layouts/app') ?>



<?= $this->section('content') ?>



<div class="container">

    <div class="row">

        <div class="col-md-8 card mx-auto my-5">

            <div class="card-header">

                <h5>Create Article</h5>

            </div>

            <div class="card-body">

                <form action="/articles/store" method="post">

                    <?= csrf_field() ?>

                    <div class="form-group mb-2">

                        <label for="title">Title</label>

                        <input type="input" name="title" class="form-control form-control-sm">

                    </div>

                    <div class="form-group mb-2">

                        <label for="content">Content</label>

                        <textarea name="content" class="form-control form-control-sm" cols="45" rows="4"></textarea>

                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>

            </div>

        </div>

    </div>

</div>



<?= $this->endSection() ?>
```
  

----------

#### 3. Create Page (`app/Views/articles/create.php`)

The create page contains a form to add new articles. It extends the app.php layout.

  
```php
<?= $this->extend('layouts/app') ?>



<?= $this->section('content') ?>



<div class="container">

    <div class="row">

        <div class="col-md-8 card mx-auto my-5">

            <div class="card-header">

                <h5>Create Article</h5>

            </div>

            <div class="card-body">

                <form action="/articles/store" method="post">

                    <?= csrf_field() ?>

                    <div class="form-group mb-2">

                        <label for="title">Title</label>

                        <input type="input" name="title" class="form-control form-control-sm">

                    </div>

                    <div class="form-group mb-2">

                        <label for="content">Content</label>

                        <textarea name="content" class="form-control form-control-sm" cols="45" rows="4"></textarea>

                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>

            </div>

        </div>

    </div>

</div>



<?= $this->endSection() ?>
```
  

----------

#### 4. Edit Page (`app/Views/articles/edit.php`)

The edit page provides a form to update an existing article. It extends the `app.php` layout.

  
```php
<?= $this->extend('layouts/app') ?>



<?= $this->section('content') ?>



<div class="container">

    <div class="row">

        <div class="col-md-8 card mx-auto my-5">

            <div class="card-header">

                <h5>Edit Article</h5>

            </div>

            <div class="card-body">

                <form action="<?= "/articles/update/{$article['id']}" ?>" method="POST">

                    <?= csrf_field() ?>

                    <div class="form-group mb-2">

                        <label for="title">Title</label>

                        <input type="input" name="title" class="form-control form-control-sm" value="<?= $article['title'] ?? '' ?>">

                    </div>

                    <div class="form-group mb-2">

                        <label for="content">Content</label>

                        <textarea name="content" class="form-control form-control-sm"><?= $article['content'] ?? '' ?></textarea>

                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>

            </div>

        </div>

    </div>

</div>



<?= $this->endSection() ?>

```