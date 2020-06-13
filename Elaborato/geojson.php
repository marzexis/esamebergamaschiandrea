
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "itbroadband";

        function geoJson()
        {
            $conn = new PDO('mysql:host=localhost;dbname=ctbappet_wp451', 'ctbappet', 'aqeB]o8682I[CM');
            //$user & $password should come from config file
            if (!$conn) {
                echo 'no connection\n';
                exit;
            }
            $sql = 'SELECT * FROM to_approve';

            $rs = $conn->query($sql);
            if (!$rs) {
                echo 'An SQL error occured.\n';
                exit;
            }

            $geojson = array(
                'type' => 'FeatureCollection',
                'features' => array(),
            );

           
            while ($row = $rs->fetch(PDO::FETCH_ASSOC)) {
                $properties = $row;
                $feature = array(
                    'type' => 'Feature', 
                    'geometry' => array(
                        'type' => 'Point',
                        # Pass Longitude and Latitude Columns here
                        'coordinates' => [doubleval ($row['YCoord']),doubleval($row['XCoord'])])

                    ,
                        # Pass other attribute columns here
                        'properties' => array(
                            'N_ADDRESSES' => $row['N_ADDRESSES'],
                            'SPEED_DOWN' => $row['SPEED_DOWN'],
                            'SPEED_DOWN' => $row['SPEED_UP'],
                            'COVERAGE' => $row['COVERAGE'],
                            'TYPE' => $row['TYPE'],

                            )
                );
                array_push($geojson['features'], $feature);
            }

            header('Content-type: application/json');
            return json_encode($geojson, JSON_PRETTY_PRINT);
           
        }


        //for local json files use code below

        $fp = fopen('banana.json', 'w');
        fwrite($fp, geoJson());
        fclose($fp);
        $conn = null;
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Content-Type: application/xml; charset=utf-8");
        ?>
        <script type="text/javascript">
  window.location="https://bergamaschi-andrea.netsons.org/edit.html"; 
</script>

        