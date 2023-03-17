<?php

session_start();

if ($_SESSION['image_is_logged_in'] == 'true') {

    $user = $_SESSION['user'];

    $nom = $_GET['id'];
    $supernom = strtoupper($nom);

    include 'config/configuracio.php';

    $select = "SELECT nom,tipus,tipus2,dia,components,tel1,tel2,email1,email2,nomf,adressf,niff,nota,kuota,fechaalta FROM usuaris WHERE nom='$nom'";

    $query = mysql_query($select);

    if (!$query) {
        die('Invalid query: ' . mysql_error());
    }

    list($nom, $tip, $tip2, $dia, $components, $tel1, $tel2, $email1, $email2, $nomf, $adressf, $niff, $nota, $kuota, $fechaalta) = mysql_fetch_row($query);

    ?>

    <html lang="es">
    <head>
        <?php include 'head.php'; ?>
        <title>aplicoop - ficha</title>
    </head>

    <body>
    <?php include 'menu.php'; ?>

    <div class="page">
        <div class="container">

            <div class="u-cf">
                <h1 class="pull-left"> Veure fam&iacute;lia <?php echo $nom; ?> </h1>
                <?php
                if ($nom == $user && ( $tip == "super" or $tip == "cist")) {

                    ?>
                    <div class="pull-right u-mt-1 u-mb-1">


                        <button class="button button--animated"
                                onClick="javascript:window.location = 'editdadesp.php';">Editar <i class="fa fa-pencil" aria-hidden="true"></i>
                        </button>
                    </div>
                    <?php
                }
                ?>
            </div>


            <div class="box">

                <table class="table table-striped table-fixed">
                    <thead>
                    <tr>
                        <td class="u-text-semibold u-text-center" colspan="2">
                            <h2>Dades personals</h2>
                        </td>
                    </tr>
                    </thead>

                    <tbody>


                    <tr class="cos_majus">
                        <td width="50%" class="u-text-semibold u-text-right u-text-right">Nom:</td>
                        <td width="50%"><?php echo $nom; ?></td>
                    </tr>
                    <tr>
                        <td class="u-text-semibold u-text-right">Permisos:</td>
                        <td><?php echo $tip; ?></td>
                    </tr>
                    <tr class="cos_majus">
                        <td class="u-text-semibold u-text-right">Data de recollida:</td>
                        <td><?php echo $dia; ?></td>
                    </tr>
                    <tr class="cos_majus">
                        <td class="u-text-semibold u-text-right">Components:</td>
                        <td><?php echo $components; ?></td>
                    </tr>
                    <tr class="cos_majus">
                        <td class="u-text-semibold u-text-right">Telèfon principal:</td>
                        <td><?php echo $tel1; ?></td>
                    </tr>
                    <tr class="cos_majus">
                        <td class="u-text-semibold u-text-right">Telèfon alternatiu:</td>
                        <td><?php echo $tel2; ?></td>
                    </tr>
                    <tr class="cos_majus">
                        <td class="u-text-semibold u-text-right">Kuota</td>
                        <td><?php echo $kuota; ?></td>
                    </tr>
                    <tr class="cos_majus">
                        <td class="u-text-semibold u-text-right">Data d'alta</td>
                        <td><?php echo $fechaalta; ?></td>
                    </tr>
                    <tr>
                        <td class="u-text-semibold u-text-right">E-mail principal:</td>
                        <td class="cos"><?php echo $email1; ?></td>
                    </tr>
                    <tr>
                        <td class="u-text-semibold u-text-right">E-mail alternatiu:</td>
                        <td class="cos"><?php echo $email2; ?></td>
                    </tr>
                    <tr>
                        <td class="u-text-semibold u-text-right">Comentaris:</td>
                        <?php
                        $nota = htmlentities($nota, null, 'utf-8');
                        $notatext = str_replace("&nbsp;", " ", $nota);
                        $notatext = html_entity_decode($notatext, null, 'utf-8');
                        ?>
                        <td class="cos"><?php echo $notatext; ?></td>
                    </tr>
                </table>

                <table class="table table-striped table-fixed">
                    <thead>
                    <tr>
                        <td class="u-text-semibold u-text-center" colspan="2">
                            <h2>Factura</h2>
                        </td>
                    </tr>
                    </thead>

                    <tbody>

                    <tr>
                        <td class="u-text-semibold u-text-right">Nom:</td>
                        <td class="cos"><?php echo $nomf; ?></td>
                    </tr>
                    <tr>
                        <td class="u-text-semibold u-text-right">Adreça:</td>
                        <td class="cos"><?php echo $adressf; ?></td>
                    </tr>
                    <tr>
                        <td class="u-text-semibold u-text-right">NIF:</td>
                        <td class="cos"><?php echo $niff; ?></td>
                    </tr>

                    </tbody>
                </table>

            </div>


        </div>
    </div>
    </body>
    </html>

    <?php
    include 'config/disconect.php';
} else {
    header("Location: index.php");
}
?>
