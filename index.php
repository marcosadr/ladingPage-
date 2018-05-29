
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Lading Page - Dados</title>
    </head>
    <body>
        
        <?php
            $name = $_POST['name'];
            $email = $_POST['email'];
            $telefone  = $_POST['telefone'];
            $empresa = $_POST['empresa'];
            $cep = $_POST['cep'];
        
        if($name && $email && $telefone && $empresa && $cep){
            
            $key = 'GAiymP5CPlaklcBuV5ul0Z3SnCHkG31M';
            $app_secret = 'DDhmGSkrxdxN8c5FD7sj97vNuwd9m12relt6nOnSWC1EOXpU';
            
            $url = "https://webmaniabr.com/api/1/cep/".$cep."/?app_key=".$key."&app_secret=".$app_secret;
            
            function callAPI($method, $url, $data){
                $curl = curl_init();
                switch ($method){
                    case "POST":
                        curl_setopt($curl, CURLOPT_POST, 1);
                        if ($data)
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                    break;
                    case "PUT":
                        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                        if ($data)
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);                         
                    break;
                    default:
                    if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
                }
                
                // OPTIONS:
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                    'APIKEY: 111111111111111111111',
                    'Content-Type: application/json',
                ));
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                
                // EXECUTE:
                $result = curl_exec($curl);
                
                if(!$result){
                    die("Connection Failure");
                }

                curl_close($curl);

                return $result;
            }
            
            $get_data = callAPI(
                'GET',
                $url,
                false);
                
                $response = json_decode($get_data, true);
        ?>   
        <div id="dataSearch">
            <h3>Dados</h3>
            <span>
                <h4><?php echo "Name: ".$name; ?></h4>
                <h4><?php echo "Email: ".$email; ?></h4>
                <h4><?php echo "Telefone: ".$telefone; ?></h4>
                <h4><?php echo "Empresa: ".$empresa; ?></h4>
            </span>
            <ul>
                <li><?php echo "Endereço: ".$response[endereco]; ?></li>
                <li><?php echo "Bairro: ".$response[bairro]; ?></li>
                <li><?php echo "Cidade: ".$response[cidade]; ?></li>
                <li><?php echo "UF: ".$response[uf]; ?></li>
                <li><?php echo "CEP: ".$response[cep]; ?></li>
            </ul>
        </div>
        <?php
        }
        else {
            header( "Location: http://localhost/ladingpage/" );
        }
        ?>
</body>
</html>