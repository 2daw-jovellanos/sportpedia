<?php
require_once "vistas/View.php";
/**
 * Esta clase representa a todo lo común a las vistas.
 * Cada parte distinta en cada vista, vendrá representada por un
 * método abstracto que la genere.
 * En este caso, el método content genera el contenido en las clases derivadas.
 */
abstract class MainView extends View 
{
    
    /**
     * Debe generar el contenido. Cada vista que herede de esta
     * debe hacer override de este método
     *
     * @return void
     */
    abstract function content();

    function setTitle(string $title) {
        $this->title = "$title - Sportpedia";
    }

    /**
     * Genera toda la plantilla.
     * Es final porque no es previsible que las clases que heredan lo cambien.
     */
    
    final function main() {
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?=$this->getExtraHead()?>
    <title><?=$this->title?></title>
</head>
<body>
<header class="jumbotron bg-dark text-white">
   <h1>Sportpedia</h1>
   La enciclopedia de los deportistas.
</header>
<div class="container">
<?=$this->content()?>
</div>
<footer class="footer bg-dark text-white">
&copy; Yomizmo 2019
</footer>    
</body>
</html>
<?php        
    }
}