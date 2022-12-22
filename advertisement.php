<?php
    require './includes/app.php';
    use App\Property;

    // Validar ID
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('Location: /index.php');
    }

    $property = Property::find($id);

    // Importar un template
    includeTemplate('header');
?>

<main class="container section center-content">
    <h1><?php echo $property->title; ?></h1>

    <img loading="lazy" src="/images/<?php echo $property->image; ?>" alt="imagen de la propiedad"> 
    
    <div class="sumary-property">
        <p class="price"><?php echo $property->price; ?>$</p>
    </div>

    <ul class="icons-features">
        <li>
            <img class="icon" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
            <p><?php echo $property->bathrooms; ?></p>
        </li>
        <li>
            <img class="icon" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
            <p><?php echo $property->parking; ?></p>
        </li>
        <li>
            <img class="icon" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
            <p><?php echo $property->bedrooms; ?></p>
        </li>
    </ul>
    
    <p>
        <?php echo $property->description; ?>
    </p>

</main>

<?php
    includeTemplate('footer');
?>
