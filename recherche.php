<html>
<head>
    <title>Moteur de recherche</title>
</head>
<body>
    <h2>Moteur de recherche</h2>
    <form action="./recherche.php" method="get">
        <input type="text" name="k" size="50" value='<?php echo $_GET["k"];?>'/>
        <input type="submit" value="recherche"/>
        <hr />
        <?php
        error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
        $i = 0;
        $k = $_GET['k'];
        $terms = explode(" ",$k);
        $query = "SELECT * FROM recherche WHERE ";
        foreach($terms as $each){
            $i++;
            if($i == 1)
            {
                $query .= "mots_cle LIKE '$each' ";
            }
            else {
                $query .= "OR mots_cle LIKE '$each' ";
            }
        }
        //connect

        mysql_connect("localhost","root","");
        mysql_select_db("recherche");
        $query=mysql_query($query);
        $numrows = mysql_num_rows($query);
        if($numrows >0)
        {
            while($row = mysql_fectch_assoc($query))
            $id = $row['id'];
            $titre = $row['titre'];
            $contenu = $row['contenu'];
            $mots_cle = $row['mots_cle'];

            echo "<h2>$titre</h2> $contenu </br>";
        }
        else
        {
            echo "Aucun résultat trouvé pour \"<b>$k</b>\"";
        }
        ?>

    </form>
</body>
</html>